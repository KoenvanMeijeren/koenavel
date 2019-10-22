<?php
declare(strict_types=1);


namespace App\Services\Session;

use App\Services\Core\Log;
use App\Services\Exceptions\Session\InvalidSessionException;
use App\Services\Session\Security as SessionSecurity;
use Cake\Chronos\Chronos;
use Exception;

class Builder
{
    /**
     * The session class
     *
     * @var Session
     */
    private $session;

    /**
     * The session security class
     *
     * @var SessionSecurity
     */
    private $security;

    /**
     * The log class
     *
     * @var Log
     */
    private $logger;

    /**
     * The name of the session.
     *
     * @var string
     */
    private $name;

    /**
     * The expiring time of the session.
     *
     * @var int
     */
    private $expiringTime;

    /**
     * The path of the session.
     *
     * @var string
     */
    private $path;

    /**
     * The domain of the session.
     *
     * @var string
     */
    private $domain;

    /**
     * Determine if the session must be secure.
     *
     * @var bool
     */
    private $secure;

    /**
     * Determine if the session must be http only.
     *
     * @var bool
     */
    private $httpOnly;

    /**
     * Construct the session.
     *
     * @param string $sessionName  the name of the session
     * @param int    $expiringTime the expiring time of the session
     * @param string $path         The path of the session
     * @param string $domain       The domain of the session
     * @param bool   $secure       Determine if the session must be secure
     * @param bool   $httpOnly     Determine if the session must be http only
     *
     * @throws Exception
     */
    public function __construct(
        string $sessionName = 'app',
        int $expiringTime = 1 * 1 * 1 * 5,
        string $path = '/',
        string $domain = '',
        bool $secure = false,
        bool $httpOnly = true
    ) {
        $this->name = $sessionName;
        $this->expiringTime = $expiringTime;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;

        $this->session = new Session();
        $this->security = new SessionSecurity();
        $this->logger = new Log();
    }

    /**
     * Start the session.
     *
     * @throws Exception
     */
    public function startSession(): void
    {
        if (PHP_SESSION_NONE === session_status() && !headers_sent()) {
            session_name($this->name);

            session_set_cookie_params(
                $this->expiringTime,  // Lifetime -- 0 means erase when browser closes
                $this->path,          // Which paths are these cookies relevant?
                $this->domain,        // Only expose this to which domain?
                $this->secure,        // Only send over the network when TLS is used
                $this->httpOnly       // Don't expose to Javascript
            );

            session_start();

            $this->logger->debug('Session has been started');
        }
    }

    /**
     * Set some security options for the session.
     *
     * @throws Exception
     */
    public function setSessionSecurity()
    {
        $this->security->userAgentProtection();
        $this->security->remoteIpProtection();
        $this->setExpiringSession();
        $this->setCanarySession();
    }

    /**
     * Set the expiring time for the session.
     *
     * @throws Exception
     */
    private function setExpiringSession(): void
    {
        $now = new Chronos();
        if (empty($this->session->get('createdAt'))) {
            $this->session->saveForced('createdAt', $now->toDateTimeString());
        }

        $sessionCreatedAt = $this->session->get('createdAt');
        $expired = new Chronos($sessionCreatedAt);
        $expired = $expired->addSeconds($this->expiringTime);

        if ($expired->lte($now) && !headers_sent()) {
            $this->logger->debug('Session has been expired.');

            $this->destroy();
        }
    }

    /**
     * Regenerate session ID every five minutes.
     *
     * @throws Exception
     */
    private function setCanarySession(): void
    {
        if (empty($this->session->get('canary'))
            && PHP_SESSION_NONE !== session_status()
        ) {
            session_regenerate_id(true);
            $this->session->saveForced('canary', (string) time());

            $this->logger->debug('Session id has been regenerated');
        }

        if ((int) $this->session->get('canary') < time() - 300
            && PHP_SESSION_NONE !== session_status()
        ) {
            session_regenerate_id(true);
            $this->session->saveForced('canary', (string) time());

            $this->logger->debug('Session id has been regenerated');
        }
    }

    /**
     * Destroy the session.
     *
     * @return void
     * @throws Exception
     */
    public function destroy(): void
    {
        if (PHP_SESSION_ACTIVE !== session_status()) {
            throw new InvalidSessionException(
                "Cannot destroy the session if the session does not exists"
            );
        }

        $this->logger->debug('The session has been destroyed.');

        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );

        session_unset();
        session_destroy();

        $this->startSession();
    }
}

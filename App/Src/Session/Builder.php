<?php
declare(strict_types=1);


namespace App\Src\Session;

use App\Src\Exceptions\Session\InvalidSessionException;
use App\Src\Session\Security as SessionSecurity;
use Cake\Chronos\Chronos;
use Exception;

final class Builder
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
        int $expiringTime = 1 * 1 * 60 * 60, //day * hours * minutes * seconds
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
    }

    /**
     * Start the session.
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
        }
    }

    /**
     * Set some security options for the session.
     *
     * @throws Exception
     */
    public function setSessionSecurity(): void
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
        if ($this->session->get('createdAt') === '') {
            $this->session->saveForced('createdAt', $now->toDateTimeString());
        }

        $sessionCreatedAt = $this->session->get('createdAt');
        $expired = new Chronos($sessionCreatedAt);
        $expired = $expired->addSeconds($this->expiringTime);

        if ($expired->lte($now) && !headers_sent()) {
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
        if ($this->session->get('canary') === ''
            && PHP_SESSION_NONE !== session_status()
        ) {
            session_regenerate_id(true);
            $this->session->saveForced('canary', (string) time());
        }

        if ((int) $this->session->get('canary') < time() - 300
            && PHP_SESSION_NONE !== session_status()
        ) {
            session_regenerate_id(true);
            $this->session->saveForced('canary', (string) time());
        }
    }

    /**
     * Destroy the session.
     *
     * @throws InvalidSessionException
     */
    public function destroy(): void
    {
        if (PHP_SESSION_ACTIVE !== session_status()) {
            throw new InvalidSessionException(
                "Cannot destroy the session if the session does not exists"
            );
        }

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

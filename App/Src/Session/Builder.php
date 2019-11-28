<?php
declare(strict_types=1);


namespace App\Src\Session;

use App\Src\Core\Cookie;
use App\Src\Exceptions\Session\InvalidSessionException;
use App\Src\Response\Redirect;
use App\Src\Session\Security as SessionSecurity;
use Cake\Chronos\Chronos;
use Exception;

final class Builder
{
    private Session $session;
    private SessionSecurity $security;

    private string $name;
    private string $path;
    private string $domain;

    private int $expiringTime;

    private bool $secure;
    private bool $httpOnly;

    /**
     * Construct the session.
     *
     * @param int $expiringTime the expiring time of the session
     * @param string $path The path of the session
     * @param string $domain The domain of the session
     * @param bool $secure Determine if the session must be secure
     * @param bool $httpOnly Determine if the session must be http only
     *
     * @throws Exception
     */
    public function __construct(
        int $expiringTime = 1 * 4 * 60 * 60, //day * hours * minutes * seconds
        string $path = '/',
        string $domain = '',
        bool $secure = false,
        bool $httpOnly = true
    ) {
        $this->name = random_string(128);
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
            $this->setSessionName();

            session_name($this->getSessionName());

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
     */
    public function setSessionSecurity(): void
    {
        $this->security->userAgentProtection();
        $this->security->remoteIpProtection();
        $this->setExpiringSession();
        $this->setCanarySession();
    }

    /**
     * Set an unique unreadable session name.
     */
    private function setSessionName(): void
    {
        $cookie = new Cookie($this->expiringTime - 1);
        if ($cookie->exists('sessionName')) {
            return;
        }

        foreach ($_COOKIE as $key => $value) {
            if (strlen($key) === strlen($this->name)) {
                $cookie->unset($key);
            }
        }

        $cookie->save('sessionName', $this->name);
    }

    /**
     * Get the session name.
     *
     * @return string
     */
    private function getSessionName(): string
    {
        $cookie = new Cookie();

        return $cookie->get('sessionName', $this->name);
    }

    /**
     * Set the expiring time for the session.
     *
     * @return Redirect|void
     * @throws Exception
     */
    private function setExpiringSession()
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
            $this->session->saveForced('canary', (string)time());
        }

        if ((int)$this->session->get('canary') < time() - 300
            && PHP_SESSION_NONE !== session_status()
        ) {
            session_regenerate_id(true);
            $this->session->saveForced('canary', (string)time());
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
        $cookie = new Cookie(
            42000,
            $params['path'] ?? '',
            $params['domain'] ?? '',
            $params['secure'] ?? false,
            $params['httponly'] ?? true
        );

        $cookie->unset(session_name());
        $cookie->unset('sessionName');

        session_unset();
        session_destroy();
    }
}

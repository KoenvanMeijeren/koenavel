<?php
declare(strict_types=1);


namespace App\services\session;

use App\services\core\Log;
use Cake\Chronos\Chronos;
use Exception;

final class Builder
{
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
        string $sessionName,
        int $expiringTime,
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

        $this->startSession();
        $this->setExpiringSession();
        $this->setCanarySession();
    }

    /**
     * Start the session.
     */
    private function startSession()
    {
        if (PHP_SESSION_NONE === session_status()) {
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
     * Set the expiring time for the session.
     *
     * @throws Exception
     */
    private function setExpiringSession()
    {
        $now = new Chronos();
        if (empty(Session::get('time'))) {
            Session::save('time', $now->toDateTimeString());
        }

        $sessionCreatedAt = Session::get('time');
        $expired = new Chronos($sessionCreatedAt);
        $expired = $expired->addSeconds($this->expiringTime);

        if ($expired->lte($now)) {
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

            Log::info('The session is destroyed.');
            new Session();
        }
    }

    /**
     * Regenerate session ID every five minutes.
     */
    private function setCanarySession()
    {
        if (!isset($_SESSION['canary'])) {
            session_regenerate_id(true);
            $_SESSION['canary'] = time();
        }

        if ($_SESSION['canary'] < time() - 300) {
            session_regenerate_id(true);
            $_SESSION['canary'] = time();
        }
    }
}

<?php
declare(strict_types=1);


namespace App\Services\Session;

use App\Services\Core\Request;
use App\Services\Log\Log;
use Exception;

final class Security
{
    /**
     * The request class
     *
     * @var Request
     */
    private $request;

    /**
     * The logger
     *
     * @var Log
     */
    private $log;

    /**
     * The session class
     *
     * @var Session
     */
    private $session;

    /**
     * Construct the security
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->log = new Log();
        $this->session = new Session();
    }

    /**
     * Set the user agent in the session to prevent hijacking.
     *
     * @throws Exception
     */
    public function userAgentProtection(): void
    {
        $userAgent = $this->request->server(Request::HTTP_USER_AGENT);

        $this->session->saveForced('user_agent', $userAgent);
        if ($this->session->get('user_agent') !== $userAgent) {
            $this->log->info(
                'Session hijacking attack has been declined'
            );

            $session = new Builder();
            $session->destroy();

            $this->session->saveForced('user_agent', $userAgent);
        }
    }

    /**
     * Set the remote ip in the session to prevent hijacking.
     *
     * @throws Exception
     */
    public function remoteIpProtection(): void
    {
        $userIP = $this->request->server(Request::USER_IP_ADDRESS);

        $this->session->saveForced('user_remote_ip', $userIP);
        if ($this->session->get('user_remote_ip') !== $userIP) {
            $this->log->info(
                'Session hijacking attack has been declined'
            );

            $session = new Builder();
            $session->destroy();

            $this->session->saveForced('user_remote_ip', $userIP);
        }
    }
}

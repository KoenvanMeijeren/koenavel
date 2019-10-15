<?php
declare(strict_types=1);


namespace App\Services\Session;

use App\Services\Core\Log;
use App\Services\Core\URI;
use Exception;

final class Security
{
    /**
     * Set the user agent in the session to prevent hijacking.
     *
     * @throws Exception
     */
    public static function userAgentProtection(): void
    {
        Session::saveForced('user_agent', URI::getUserAgent());

        if (Session::get('user_agent') !== URI::getUserAgent()) {
            Log::info('Session hijacking attack has declined');
            Session::destroy();
        }
    }

    /**
     * Set the remote ip in the session to prevent hijacking.
     *
     * @throws Exception
     */
    public static function remoteIpProtection(): void
    {
        Session::saveForced('user_remote_ip', URI::getRemoteIp());

        if (Session::get('user_remote_ip') !== URI::getRemoteIp()) {
            Log::info('Session hijacking attack has declined');
            Session::destroy();
        }
    }
}

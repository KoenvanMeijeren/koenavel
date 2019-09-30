<?php
declare(strict_types=1);


namespace App\services\session;

use App\services\core\Log;
use App\services\core\URI;
use Exception;

final class Security
{
    /**
     * Set the user agent in the session to prevent hijacking.
     *
     * @throws Exception
     */
    public static function userAgentProtection()
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
    public static function remoteIpProtection()
    {
        Session::saveForced('user_remote_ip', URI::getRemoteIp());

        if (Session::get('user_remote_ip') !== URI::getRemoteIp()) {
            Log::info('Session hijacking attack has declined');
            Session::destroy();
        }
    }
}

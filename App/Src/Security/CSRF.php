<?php

declare(strict_types=1);

namespace App\Src\Security;

use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use Exception;
use ParagonIE\AntiCSRF\AntiCSRF;

final class CSRF
{
    /**
     * Must the csrf token be shown?
     *
     * @var bool
     */
    const ECHO_CSRF_TOKEN = false;

    private static AntiCSRF $csrf;

    /**
     * Construct the csrf
     */
    private function __construct()
    {
        self::$csrf = new AntiCSRF();
    }

    /**
     * Add the token to the form and lock it to an URL.
     *
     * @param string $lockTo the request is locked to the given URL
     *
     * @return string
     * @throws Exception
     */
    public static function insertToken(string $lockTo): string
    {
        new CSRF();
        return self::$csrf->insertToken($lockTo, self::ECHO_CSRF_TOKEN);
    }

    /**
     * Check if the posted token is valid.
     *
     * @return bool
     * @throws Exception
     */
    public static function validate(): bool
    {
        $session = new Session();

        new CSRF();
        if (self::$csrf->validateRequest()) {
            return true;
        }

        $session->flash(
            State::FAILED,
            Translation::get('failed_csrf_check_message')
        );
        return false;
    }
}

<?php

declare(strict_types=1);

namespace App\services\security;

use App\services\core\Config;
use App\services\core\Request;
use App\services\core\URI;
use App\services\session\Session;
use App\services\translation\Translation;
use Exception;

/**
 * TODO: find out how this class can be tested automatically
 */
final class Recaptcha
{
    /**
     * The http request for google recaptcha.
     *
     * @var array
     */
    private $query = [];

    /**
     * Build the recaptcha http request.
     *
     * @param Request $request the request for the post item
     *
     * @throws Exception
     */
    public function __construct(Request $request)
    {
        $recaptcha = http_build_query(
            [
                'secret' => Config::get('recaptcha_secret_key'),
                'response' => $request->post('g-recaptcha-response'),
                'remoteip' => URI::getRemoteIp(),
            ]
        );

        $this->query = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $recaptcha,
            ],
        ];
    }

    /**
     * Validate the recaptcha request.
     *
     * @return bool
     * @throws Exception
     */
    public function validate(): bool
    {
        $context = stream_context_create($this->query);
        $response = file_get_contents(
            'https://www.google.com/recaptcha/api/siteverify',
            false,
            $context
        );

        if (is_string($response)) {
            $recaptchaResult = json_decode($response);
        }

        if (isset($recaptchaResult) && $recaptchaResult->success) {
            return true;
        }

        Session::flash('error', Translation::get('failed_recaptcha_check_message'));
        return false;
    }
}

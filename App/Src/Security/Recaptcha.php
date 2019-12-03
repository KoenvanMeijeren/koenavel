<?php

declare(strict_types=1);

namespace App\Src\Security;

use App\Src\Config\Config;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use Exception;

final class Recaptcha
{
    /**
     * The http request for google recaptcha.
     */
    private array $query = [];

    /**
     * Build the recaptcha http request.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $request = new Request();
        $config = new Config();

        $recaptcha = http_build_query([
            'secret' => $config->get('recaptcha_secret_key')->toString(),
            'response' => $request->post('g-recaptcha-response'),
            'remoteip' => $request->server(Request::USER_IP_ADDRESS),
        ]);

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
        $response = (string) file_get_contents(
            'https://www.google.com/recaptcha/api/siteverify',
            false,
            $context
        );

        $recaptchaResult = json_decode(
            $response,
            false,
            512,
            JSON_THROW_ON_ERROR
        );
        if ($recaptchaResult->success) {
            return true;
        }

        $session = new Session();
        $session->flash(
            State::FAILED,
            Translation::get('failed_recaptcha_check_message')
        );
        return false;
    }
}

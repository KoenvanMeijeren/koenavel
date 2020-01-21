<?php

declare(strict_types=1);

namespace App\Src\Core;

use App\Src\Validate\Validate;
use Exception;

final class Mail
{
    private string $headers;
    private string $receivers;
    private string $subject;
    private string $body;

    /**
     * Construct the PHPMailer.
     */
    public function __construct()
    {
        $this->headers = 'MIME-Version: 1.0 \r\n';
        $this->headers .= 'Content-type:text/html;charset=UTF-8 \r\n';
    }

    /**
     * Set the recipients for the mail.
     *
     * @param string $address the address of the receiver
     */
    public function addAddress(string $address): void
    {
        $this->receivers .= $address;
    }

    /**
     * Set the reply to for the mail.
     *
     * @param string $address the address of the receiver
     * @param string $name    the name of the receiver
     */
    public function setFrom(string $address, string $name = ''): void
    {
        $this->headers .= 'From: '.$name.' <'.$address.'>'."\r\n";
    }

    /**
     * Set the mail body.
     *
     * @param string    $subject  the subject of the mail
     * @param string    $htmlBody the html body of the mail
     * @param mixed[]   $vars     the vars to use in the mail
     *
     * @throws Exception
     */
    public function setBody(
        string $subject,
        string $htmlBody,
        array $vars = []
    ): void {
        extract($vars, EXTR_SKIP);

        $this->subject = $subject;

        // set the html body
        $filename = RESOURCES_PATH."/partials/mails/{$htmlBody}.view.php";
        Validate::var($filename)->fileExists()->isReadable();
        $htmlBody = (string) file_get_contents($filename);

        // save the html body
        $this->body = $htmlBody;
    }

    /**
     * Send a new mail.
     *
     * @throws Exception
     */
    public function send(): void
    {
        $env = new Env();

        if (Env::PRODUCTION === $env->get()) {
            mail($this->receivers, $this->subject, $this->body, $this->headers);
        }
    }
}

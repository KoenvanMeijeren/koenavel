<?php

declare(strict_types=1);

namespace App\Services\Core;

use App\Services\Validate\Validate;
use Exception;

final class Mail
{
    /**
     * The headers of the mail.
     *
     * @var string
     */
    private $headers;

    /**
     * The receivers of the mail.
     *
     * @var string
     */
    private $receivers;

    /**
     * Set the subject.
     *
     * @var string
     */
    private $subject;

    /**
     * Set the body of the mail.
     *
     * @var string
     */
    private $body;

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
     * @param string $subject  the subject of the mail
     * @param string $htmlBody the html body of the mail
     * @param mixed  $vars     the vars to use in the mail
     *
     * @throws Exception
     */
    public function setBody(string $subject, string $htmlBody, $vars = null): void
    {
        if (!empty($vars)) {
            extract($vars);
        }

        $this->subject = $subject;

        // set the html body
        $filename = RESOURCES_PATH."/partials/mails/{$htmlBody}.view.php";
        Validate::var($filename)->fileExists()->isReadable();
        $htmlBody = (string) file_get_contents($filename);

        // replace some specials vars in the mail
        $htmlBody = str_replace('{token}', $token ?? '', $htmlBody);
        $htmlBody = str_replace('{email}', $email ?? '', $htmlBody);
        $htmlBody = str_replace('{subject}', $subject ?? '', $htmlBody);
        $htmlBody = str_replace('{message}', $message ?? '', $htmlBody);
        $htmlBody = str_replace('{workspaceName}', $workspaceName ?? '', $htmlBody);
        $htmlBody = str_replace('{date}', $date ?? '', $htmlBody);
        $htmlBody = str_replace('{time}', $time ?? '', $htmlBody);
        $htmlBody = str_replace('{title}', $title ?? '', $htmlBody);
        $htmlBody = str_replace('{location}', $location ?? '', $htmlBody);

        // save the html body
        $this->body = (string) $htmlBody;
    }

    /**
     * Send a new mail.
     *
     * @throws Exception
     */
    public function send(): void
    {
        if (Env::PRODUCTION === Config::get('env')->toString()) {
            mail($this->receivers, $this->subject, $this->body, $this->headers);
        }
    }
}

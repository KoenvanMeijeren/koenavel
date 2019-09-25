<?php
declare(strict_types=1);


namespace App\services\core;


class URI
{
    /**
     * Get the url.
     *
     * @return string
     */
    public static function getUrl()
    {
        $sanitize = new Sanitize($_SERVER['REQUEST_URI'], 'url');

        return $sanitize->data();
    }

    /**
     * Get the previous url.
     *
     * @return string
     */
    public static function getPreviousUrl()
    {
        $sanitize = new Sanitize($_SERVER['HTTP_REFERER'], 'url');

        return $sanitize->data();
    }

    /**
     * Get the domain extension.
     *
     * @return string
     */
    public static function getDomainExtension()
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $hostExploded = explode('.', $host);
        $arrayKeyLast = array_key_last($hostExploded);

        return $hostExploded[$arrayKeyLast] ?? 'nl';
    }

    /**
     * Get the host of the app.
     *
     * @return string
     */
    public static function getHost()
    {
        return $_SERVER['HTTP_HOST'] ?? '';
    }

    /**
     * Get the remote ip of the app.
     *
     * @return string
     */
    public static function getRemoteIp()
    {
        return $_SERVER['REMOTE_ADDR'] ?? '';
    }

    /**
     * Get the user agent.
     *
     * @return string
     */
    public static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    /**
     * Redirect to a specific url.
     *
     * @param string $url the url to redirect
     */
    public static function redirect(string $url)
    {
        header('Location: '.$url);
    }

    /**
     * Refresh the page.
     *
     * @param string $url         the url to refresh
     * @param int    $refreshTime the refresh time
     */
    public static function refresh(string $url, int $refreshTime)
    {
        $sanitize = new Sanitize($url, 'url');

        header("Refresh: {$refreshTime}; URL=/".$sanitize->data());
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'] ?? '';
    }
}

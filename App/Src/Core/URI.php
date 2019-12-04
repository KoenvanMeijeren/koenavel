<?php
declare(strict_types=1);


namespace App\Src\Core;

final class URI
{
    /**
     * Get the url.
     *
     * @return string
     */
    public static function getUrl(): string
    {
        $request = new Request();

        $sanitize = new Sanitize($request->server(Request::URI), 'url');

        return (string)$sanitize->data();
    }

    /**
     * Get the used method for accessing the page.
     *
     * @return string
     */
    public static function getMethod(): string
    {
        $request = new Request();

        return $request->server(Request::METHOD);
    }

    /**
     * Get the previous url.
     *
     * @return string
     */
    public static function getPreviousUrl(): string
    {
        $request = new Request();

        $sanitize = new Sanitize(
            $request->server(Request::HTTP_REFERER),
            'url'
        );

        return (string)$sanitize->data();
    }

    /**
     * Get the domain extension.
     *
     * @return string
     */
    public static function getDomainExtension(): string
    {
        $request = new Request();

        $hostExploded = explode(
            '.',
            $request->server(Request::HTTP_HOST)
        );
        $arrayKeyLast = array_key_last($hostExploded);

        return $hostExploded[$arrayKeyLast] ?? 'nl';
    }

    /**
     * Redirect to a specific url.
     *
     * @param string $url the url to redirect
     */
    public static function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }

    /**
     * Refresh the page.
     *
     * @param string $url the url to refresh
     * @param int $refreshTime the refresh time
     */
    public static function refresh(string $url, int $refreshTime): void
    {
        $sanitize = new Sanitize($url, 'url');

        header("Refresh: {$refreshTime}; URL=/" . $sanitize->data());
    }
}

<?php
declare(strict_types=1);


namespace App\Services\Core;

class URI
{
    /**
     * The request
     *
     * @var Request
     */
    private $request;

    /**
     * Construct the uri.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Get the url.
     *
     * @return string
     */
    public function getUrl(): string
    {
        $sanitize = new Sanitize(
            $this->request->server(Request::URI),
            'url'
        );

        return (string) $sanitize->data();
    }

    /**
     * Get the used method for accessing the page.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->request->server(Request::METHOD);
    }

    /**
     * Get the previous url.
     *
     * @return string
     */
    public function getPreviousUrl(): string
    {
        $sanitize = new Sanitize(
            $this->request->server(Request::HTTP_REFERER),
            'url'
        );

        return (string) $sanitize->data();
    }

    /**
     * Get the domain extension.
     *
     * @return string
     */
    public function getDomainExtension(): string
    {
        $hostExploded = explode(
            '.',
            $this->request->server(Request::HTTP_HOST)
        );
        $arrayKeyLast = array_key_last($hostExploded);

        return $hostExploded[$arrayKeyLast] ?? 'nl';
    }

    /**
     * Redirect to a specific url.
     *
     * @param string $url the url to redirect
     * @codeCoverageIgnore
     */
    public function redirect(string $url): void
    {
        header('Location: '.$url);
    }

    /**
     * Refresh the page.
     *
     * @param string $url         the url to refresh
     * @param int    $refreshTime the refresh time
     * @codeCoverageIgnore
     */
    public function refresh(string $url, int $refreshTime): void
    {
        $sanitize = new Sanitize($url, 'url');

        header("Refresh: {$refreshTime}; URL=/".$sanitize->data());
    }
}

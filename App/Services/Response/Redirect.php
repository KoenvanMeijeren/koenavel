<?php
declare(strict_types=1);


namespace App\Services\Response;

use App\Services\Core\URI;

/**
 * TODO: find out how this class can be tested automatically
 */
class Redirect
{
    /**
     * The path to redirect to.
     *
     * @var string
     */
    private $path;

    /**
     * Construct the path and redirect to the path.
     *
     * @param string $path the path to redirect to
     */
    public function __construct(string $path)
    {
        $this->path = $path;

        $this->redirect(new URI());
    }

    /**
     * Redirect the path.
     *
     * @var URI $uri the uri object
     */
    private function redirect(URI $uri): void
    {
        $uri->redirect($this->path);
    }
}

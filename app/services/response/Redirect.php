<?php
declare(strict_types=1);


namespace App\services\response;


use App\services\core\URI;

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

        $this->redirect();
    }

    /**
     * Redirect the path.
     */
    private function redirect()
    {
        URI::redirect($this->path);
    }
}

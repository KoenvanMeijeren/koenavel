<?php
declare(strict_types=1);


namespace App\services\core;


use Exception;

final class View
{
    /**
     * Load a view and return it.
     *
     * @param string $name the name of the view
     * @param mixed  $data the data to be used in the view
     *
     * @throws Exception
     */
    public function __construct(string $name, $data = null)
    {
        loadFile(RESOURCES_PATH."/views/{$name}.view.php", $data);
    }
}

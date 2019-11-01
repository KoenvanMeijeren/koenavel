<?php
declare(strict_types=1);


namespace App\Src\View;

use App\Src\Exceptions\File\FileNotFoundException;

final class View
{
    /**
     * Load a view and return it.
     *
     * @param string    $name the name of the view
     * @param mixed[]   $data the data to be used in the view
     *
     * @throws FileNotFoundException
     */
    public function __construct(string $name, array $data = [])
    {
        loadFile(RESOURCES_PATH."/views/{$name}.view.php", $data);
    }
}

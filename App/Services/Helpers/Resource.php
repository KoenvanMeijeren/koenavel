<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use App\Src\File\File;

abstract class Resource
{
    final public static function loadFlashMessage(): void
    {
        includeFile(RESOURCES_PATH . '/views/partials/flash.view.php');
    }

    final public static function loadCollapsibleDiv(
        string $target,
        string $form
    ): string {
        $id = $target;

        $file = new File(
            RESOURCES_PATH . '/views/partials/forms/',
            "{$form}.view.php"
        );

        return $file->get(compact('id'));
    }
}

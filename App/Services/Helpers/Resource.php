<?php
declare(strict_types=1);


namespace App\Services\Helpers;

abstract class Resource
{
    final public static function loadFlashMessage(): void
    {
        includeFile(RESOURCES_PATH . '/views/partials/flash.view.php');
    }
}

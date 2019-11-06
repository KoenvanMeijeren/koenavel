<?php
declare(strict_types=1);


namespace App\Services\Helpers;

abstract class Resource
{
    final public static function loadFlashMessage(): void
    {
        loadFile(RESOURCES_PATH . '/partials/flash.view.php');
    }
}
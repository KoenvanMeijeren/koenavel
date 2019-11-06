<?php
declare(strict_types=1);


namespace App\Services\Helpers;


class Resource
{
    public static function loadFlashMessage(): void
    {
        loadFile(RESOURCES_PATH . '/partials/flash.view.php');
    }
}

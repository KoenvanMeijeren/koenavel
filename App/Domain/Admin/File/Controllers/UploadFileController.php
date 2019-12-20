<?php
declare(strict_types=1);


namespace App\Domain\Admin\File\Controllers;

use App\Domain\Admin\File\Actions\UploadFileAction;

final class UploadFileController
{
    public function store(): void
    {
        $upload = new UploadFileAction();

        $upload->execute();
    }
}

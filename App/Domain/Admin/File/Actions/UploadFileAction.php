<?php
declare(strict_types=1);


namespace App\Domain\Admin\File\Actions;

use App\Src\Action\FileAction;
use App\Src\Core\Request;
use App\Src\Core\Upload;

final class UploadFileAction extends FileAction
{
    public function __construct()
    {
        $request = new Request();

        $this->acceptedOrigins[] = $request->env('appUri');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): void
    {
        reset($_FILES);
        $temp = current($_FILES);

        $uploader = new Upload($temp);

        if (sizeof($temp) > 0
            && $uploader->prepare()
            && $uploader->getFileIfItExists() === ''
        ) {
            $uploader->execute();
        }

        echo json_encode(
            array('location' => $uploader->getFileIfItExists()),
            JSON_THROW_ON_ERROR,
            512
        );
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        $request = new Request();

        if (!in_array(
            $request->server(Request::HTTP_ORIGIN),
            $this->acceptedOrigins,
            true
        )
        ) {
            header('HTTP/1.1 403 Origin Denied');

            return false;
        }

        header(
            'Access-Control-Allow-Origin: ' .
            $request->server(Request::HTTP_ORIGIN)
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}

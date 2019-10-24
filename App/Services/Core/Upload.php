<?php
declare(strict_types=1);


namespace App\Services\Core;

use App\Services\Exceptions\File\ErrorWhileUploadingFileException;
use App\Services\Log\Log;
use App\Services\Session\Session;
use App\Services\Translation\Translation;
use Exception;
use Sirius\Upload\Handler as UploadHandler;

class Upload
{
    /**
     * The various allowed file options
     *
     * @var string[]
     */
    const ALLOWED_FILE_TYPES = [
        'image/jpg', 'image/jpeg',
        'image/svg+xml', 'image/png'
    ];

    /**
     * The logger.
     *
     * @var Log
     */
    private $log;

    /**
     * The session.
     *
     * @var Session
     */
    private $session;

    /**
     * The file.
     *
     * @var array
     */
    private $file;

    /**
     * The path of the file.
     *
     * @var string
     */
    private $path;

    /**
     * The striped path of the file.
     *
     * @var string
     */
    private $stripedPath;

    /**
     * The stored path of the file.
     *
     * @var string
     */
    private $storedPath;

    /**
     * Prepare the file.
     *
     * @param string[] $file the file
     * @param string $path the path to store the file in
     * @param string $stripedPath the striped path to store the file in
     *
     * @throws Exception
     */
    public function __construct(
        array $file,
        string $path = STORAGE_PATH . '/media/',
        string $stripedPath = '/storage/media/'
    ) {
        $this->log = new Log();
        $this->session = new Session();

        $this->file = $file;
        $this->path = $path;
        $this->stripedPath = $stripedPath;
    }

    /**
     * Prepare the file.
     *
     * @return bool
     *
     * @throws Exception
     */
    public function prepare(): bool
    {
        return $this->convertFileName();
    }

    /**
     * Get the file location if the file exists.
     *
     * @return string
     */
    public function getFileIfItExists(): string
    {
        $request = new Request();

        $documentRoot = $request->server(Request::DOCUMENT_ROOT);
        $fileLocation = $this->stripedPath . $this->file['name'];
        $file = $documentRoot.$fileLocation;

        return file_exists($file) ? $fileLocation : '';
    }

    /**
     * Upload the file.
     *
     * @return bool
     *
     * @throws ErrorWhileUploadingFileException
     * @throws Exception
     */
    public function execute(): bool
    {
        $uploadHandler = new UploadHandler($this->path);

        $uploadHandler->addRule(
            'extension',
            ['allowed' => ['jpg', 'jpeg', 'png', 'svg']],
            '{label} should be a valid image (jpg, jpeg, png, svg)',
            'Profile picture'
        );
        $uploadHandler->addRule(
            'size',
            ['max' => '8M'],
            '{label} should have less than {max}',
            'Profile picture'
        );

        $result = $uploadHandler->process($this->file);
        if ($result->isValid()) {
            try {
                $result->confirm();
                $filename = isset($result->name) ? $result->name : '';
                $this->setStoredFilePath($this->stripedPath . $filename);

                return true;
            } catch (Exception $exception) {
                $result->clear();

                $this->log->error($exception->getMessage());
                throw new ErrorWhileUploadingFileException(
                    'There was an error while uploading the file',
                    114,
                    $exception
                );
            }
        }

        $this->session->flash(
            'error',
            Translation::get('error_while_uploading_file')
        );
        return false;
    }

    /**
     * Get the stored file path.
     *
     * @return string
     */
    public function getStoredFilePath(): string
    {
        return $this->storedPath;
    }

    /**
     * Convert the file name into a non readable name.
     *
     * @return bool
     *
     * @throws Exception
     */
    private function convertFileName(): bool
    {
        $randomBytes = bin2hex($this->file['name']);
        $randomBytes .= bin2hex(random_bytes(40));
        $type = isset($this->file['type'], $this->file['name']) ? $this->file['type'] : '' ;

        if (!key_exists($type, self::ALLOWED_FILE_TYPES)) {
            $this->session->flash(
                'error',
                Translation::get('not_allowed_file_upload')
            );
            return false;
        }

        $this->file['name'] = $randomBytes.self::ALLOWED_FILE_TYPES[$type];
        return true;
    }

    /**
     * Set the stored file path.
     *
     * @param string $path the stored path of the file
     */
    private function setStoredFilePath(string $path): void
    {
        $this->storedPath = $path;
    }
}

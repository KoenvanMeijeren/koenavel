<?php
declare(strict_types=1);


namespace App\services\core;


use App\services\session\Session;
use App\services\translation\Translation;
use Exception;
use Sirius\Upload\Handler as UploadHandler;

/**
 * TODO: find out how this class can be tested automatically
 */
class Upload
{
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
     * @param array $file the file
     * @param string $path the path to store the file in
     * @param string $stripedPath the striped path to store the file in
     */
    public function __construct(
        array $file,
        string $path = STORAGE_PATH . '/media/',
        string $stripedPath = '/storage/media/'
    ) {
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
    public function prepare()
    {
        return $this->convertFileName();
    }

    /**
     * Get the file location if the file exists.
     *
     * @return string
     */
    public function getFileIfItExists()
    {
        $fileLocation = $this->stripedPath . $this->file['name'];

        return file_exists($_SERVER['DOCUMENT_ROOT'] . $fileLocation) ? $fileLocation : '';
    }

    /**
     * Upload the file.
     *
     * @return bool
     *
     * @throws Exception
     */
    public function execute()
    {
        $uploadHandler = new UploadHandler($this->path);

        $uploadHandler->addRule(
            'extension',
            ['allowed' => ['jpg', 'jpeg', 'png', 'svg']],
            '{label} should be a valid image (jpg, jpeg, png, svg)',
            'Profile picture'
        );
        $uploadHandler->addRule(
            'size', ['max' => '8M'],
            '{label} should have less than {max}',
            'Profile picture'
        );

        $result = $uploadHandler->process($this->file);
        if ($result->isValid()) {
            try {
                $result->confirm();
                $filename = $result->name ?? '';
                $this->setStoredFilePath($this->stripedPath . $filename);

                return true;
            } catch (Exception $exception) {
                $result->clear();

                Log::error($exception->getMessage());
                return false;
            }
        }

        Session::flash('error', Translation::get('error_while_uploading_file'));
        return false;
    }

    /**
     * Get the stored file path.
     *
     * @return string
     */
    public function getStoredFilePath()
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
    private function convertFileName()
    {
        $randomBytes = bin2hex($this->file['name']);
        $randomBytes .= bin2hex(random_bytes(40));

        if (isset($this->file['type'], $this->file['name'])) {
            switch ($this->file['type']) {
                case 'image/png':
                    $this->file['name'] = $randomBytes . '.png';

                    return true;
                    break;
                case 'image/jpg':
                    $this->file['name'] = $randomBytes . '.jpg';

                    return true;
                    break;
                case 'image/jpeg':
                    $this->file['name'] = $randomBytes . '.jpeg';

                    return true;
                    break;
                case 'image/svg+xml':
                    $this->file['name'] = $randomBytes . '.svg';

                    return true;
                    break;
                default:
                    Session::flash('error',
                        Translation::get('not_allowed_file_upload'));

                    return false;
                    break;
            }
        }

        Session::flash('error', Translation::get('error_while_uploading_file'));
        return false;
    }

    /**
     * Set the stored file path.
     *
     * @param string $path the stored path of the file
     */
    private function setStoredFilePath(string $path)
    {
        $this->storedPath = $path;
    }
}

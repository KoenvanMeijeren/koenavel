<?php
declare(strict_types=1);


namespace App\services\core;

final class Sanitize
{
    /**
     * The data to be sanitized.
     *
     * @var string|bool|float|int
     */
    private $data;

    /**
     * The typo of the data.
     *
     * @var string
     */
    private $type;

    /**
     * The flags for htmlspecialchars filtering.
     *
     * @var int
     */
    private $flags;

    /**
     * The encoding for htmlspecialchars filtering.
     *
     * @var string
     */
    private $encoding;

    /**
     * Construct the data.
     *
     * @param string|float|double|int|bool $data     the data to be sanitized
     * @param string                       $type     the type of the data
     * @param int                          $flags    the flags for htmlspecialchars filtering
     * @param string                       $encoding the encoding for htmlspecialchars filtering
     */
    public function __construct(
        $data,
        string $type = '',
        int $flags = ENT_NOQUOTES,
        string $encoding = 'UTF-8'
    ) {
        $this->data = $data;
        $this->type = empty($type) ? gettype($data) : $type;
        $this->flags = $flags;
        $this->encoding = $encoding;
    }

    /**
     * Strip the data to prevent attacks such as XSS and SQL injection.
     *
     * @return string|double|float|int|bool
     */
    public function data()
    {
        if (is_string($this->data)) {
            $data = htmlspecialchars($this->data, $this->flags, $this->encoding);
        }

        return self::filterData($data ?? $this->data);
    }

    /**
     * Filter the data.
     *
     * @param string|float|double|int|bool $data the data to be filtered
     *
     * @return string|float|double|int|bool
     */
    private function filterData($data)
    {
        switch ($this->type) {
        case 'string':
            $data = (string) filter_var($data, FILTER_SANITIZE_STRING);
            $data = trim($data);

            break;
        case 'integer':
            $data = (int) filter_var($data, FILTER_SANITIZE_NUMBER_INT);

            break;
        case 'float':
            $data = (float) filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);

            break;
        case 'url':
            $data = parse_url((string) $data, PHP_URL_PATH);
            $data = trim((string) $data, '/');
            $data = filter_var($data, FILTER_SANITIZE_URL);

            break;
        default:
            $data = filter_var($data);

            break;
        }

        return $data;
    }
}

<?php
declare(strict_types=1);


namespace App\Src\Core;

final class Sanitize
{
    /**
     * The various variable type options
     *
     * @var string
     */
    const TYPE_STRING = 'string';
    const TYPE_INT = 'integer';
    const TYPE_DOUBLE = 'double';
    const TYPE_FLOAT = 'float';
    const TYPE_URL = 'url';

    /**
     * The data to be sanitized.
     *
     * @var string|bool|float|double|int
     */
    private $data;
    private string $type;
    private int $flags;
    private string $encoding;

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
        $this->type = $type === '' ? gettype($data) : $type;
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

        return $this->filterData($data ?? $this->data);
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
        if ($this->type === self::TYPE_STRING) {
            $data = (string) filter_var($data, FILTER_SANITIZE_STRING);
            return trim($data);
        } elseif ($this->type === self::TYPE_INT) {
            return (int) filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        } elseif ($this->type === self::TYPE_DOUBLE
            || $this->type === self::TYPE_FLOAT) {
            return (double) filter_var($data);
        } elseif ($this->type === self::TYPE_URL) {
            $data = parse_url((string) $data, PHP_URL_PATH);
            $data = trim((string) $data, '/');
            return filter_var($data, FILTER_SANITIZE_URL);
        }

        return filter_var($data);
    }
}

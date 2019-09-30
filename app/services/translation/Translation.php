<?php
declare(strict_types=1);


namespace App\services\translation;

use App\services\core\Sanitize;
use Exception;

final class Translation
{
    /**
     * The translation items loaded based on the current language id.
     *
     * @var array
     */
    private static $translation = [];

    /**
     * Set a new translation item.
     *
     * @param string $key   the key to save the value in
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    public static function set(string $key, string $value)
    {
        if (isset(self::$translation[$key])) {
            throw new Exception(
                "Other translation was found with the given key: {$key} and the value is: "
                . self::$translation[$key]
            );
        }

        self::$translation[$key] = (new Sanitize($value))->data();
    }

    /**
     * Get a specific stored config item.
     *
     * @param string $key the key to search for the corresponding value in the config array
     *
     * @return string
     *
     * @throws Exception
     */
    public static function get(string $key)
    {
        if (!isset(self::$translation[$key])) {
            throw new Exception('No translation was found with the given key');
        }

        $sanitize = new Sanitize(self::$translation[$key]);
        return htmlspecialchars_decode((string) $sanitize->data());
    }
}

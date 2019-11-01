<?php
declare(strict_types=1);


namespace App\Src\Translation;

use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Exceptions\File\FileNotFoundException;

final class Translation extends Loader
{
    /**
     * The translation items loaded based on the current language id.
     *
     * @var array
     */
    private static $translation = [];

    /**
     * Construct the translations.
     *
     * @throws FileNotFoundException
     * @throws NoTranslationsForGivenLanguageID
     */
    private function __construct()
    {
        parent::__construct();

        self::$translation = $this->loadTranslations();
    }

    /**
     * Get a specific stored config item.
     *
     * @param string $key the key to search for the
     *                    corresponding value in the translations
     *
     * @return string
     * @throws FileNotFoundException
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public static function get(string $key): string
    {
        new self();

        if (!isset(self::$translation[$key])) {
            throw new InvalidKeyException(
                "No translation was found with key: {$key}"
            );
        }

        return self::$translation[$key];
    }
}

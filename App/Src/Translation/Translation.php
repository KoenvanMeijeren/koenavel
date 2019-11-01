<?php
declare(strict_types=1);


namespace App\Src\Translation;

use App\Src\Core\URI;
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
    private static $translations = [];

    /**
     * Construct the translations.
     *
     * @throws FileNotFoundException
     * @throws NoTranslationsForGivenLanguageID
     */
    protected function __construct()
    {
        if (strstr(URI::getDomainExtension(), 'localhost')
            || strstr(URI::getDomainExtension(), 'nl')
        ) {
            $this->language = self::DUTCH_LANGUAGE_ID;
        } elseif (strstr(URI::getDomainExtension(), 'com')) {
            $this->language = self::ENGLISH_LANGUAGE_ID;
        }

        self::$translations = $this->loadTranslations();
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

        if (array_key_exists($key, self::$translations)) {
            return self::$translations[$key];
        }

        throw new InvalidKeyException(
            "No translation was found with key: {$key}"
        );
    }
}

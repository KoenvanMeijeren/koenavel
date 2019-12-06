<?php
declare(strict_types=1);


namespace App\Src\Translation;

use App\Src\Core\URI;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;

final class Translation extends Loader
{
    private static array $translations = [];

    /**
     * Construct the translations.
     *
     * @throws NoTranslationsForGivenLanguageID
     */
    protected function __construct()
    {
        if (strpos(URI::getDomainExtension(), 'localhost') !== false
            || strpos(URI::getDomainExtension(), 'nl') !== false
        ) {
            $this->language = self::DUTCH_LANGUAGE_ID;
        } elseif (strpos(URI::getDomainExtension(), 'com') !== false) {
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

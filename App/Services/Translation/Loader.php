<?php
declare(strict_types=1);


namespace App\Services\Translation;

use App\Services\Core\URI;
use App\Services\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Services\Exceptions\File\FileNotFoundException;

class Loader
{
    /**
     * The language options.
     */
    const DUTCH_LANGUAGE_ID = 1;
    const ENGLISH_LANGUAGE_ID = 2;

    /**
     * The current application language id.
     */
    private $language = 0;

    /**
     * Construct the language.
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
    }

    /**
     * Get the language id.
     *
     * @return int
     */
    protected function getLanguageID(): int
    {
        return $this->language;
    }

    /**
     * Load the translations based on the language id.
     *
     * @return string[]
     * @throws NoTranslationsForGivenLanguageID
     * @throws FileNotFoundException
     */
    protected function loadTranslations(): array
    {
        if (self::DUTCH_LANGUAGE_ID === $this->getLanguageID()) {
            $filename = '/language/dutch/dutch_translations.php';

            return loadFile(RESOURCES_PATH . $filename);
        } elseif (self::ENGLISH_LANGUAGE_ID === $this->getLanguageID()) {
            $filename = '/language/english/english_translations.php';

            return loadFile(RESOURCES_PATH . $filename);
        }

        throw new NoTranslationsForGivenLanguageID(
            'No translations where found for the given language id: '.
            $this->getLanguageID()
        );
    }
}

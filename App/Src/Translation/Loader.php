<?php
declare(strict_types=1);


namespace App\Src\Translation;

use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Exceptions\File\FileNotFoundException;

abstract class Loader
{
    /**
     * The language options.
     *
     * @var int
     */
    const DUTCH_LANGUAGE_ID = 1;
    const DUTCH_LANGUAGE_CODE = 'nl';
    const ENGLISH_LANGUAGE_ID = 2;
    const ENGLISH_LANGUAGE_CODE = 'en';

    /**
     * The current application language id.
     *
     * @var int
     */
    protected $language = 0;

    /**
     * Construct the language.
     */
    abstract protected function __construct();

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
    abstract public static function get(string $key): string;

    /**
     * Load the translations based on the language id.
     *
     * @return string[]
     * @throws NoTranslationsForGivenLanguageID
     * @throws FileNotFoundException
     */
    final protected function loadTranslations(): array
    {
        if (self::DUTCH_LANGUAGE_ID === $this->language) {
            $filename = '/language/dutch/dutch_translations.php';

            return loadFile(RESOURCES_PATH . $filename);
        } elseif (self::ENGLISH_LANGUAGE_ID === $this->language) {
            $filename = '/language/english/english_translations.php';

            return loadFile(RESOURCES_PATH . $filename);
        }

        throw new NoTranslationsForGivenLanguageID(
            'No translations where found for the given language id: '.
            $this->language
        );
    }
}

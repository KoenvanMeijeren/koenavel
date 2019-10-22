<?php
declare(strict_types=1);


namespace App\Services\Translation;

use App\Services\Core\Config;
use App\Services\Core\URI;
use App\Services\Exceptions\Basic\DuplicatedKeyException;
use App\Services\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\services\exceptions\file\FileNotExistingException;

final class Builder
{
    /**
     * The language options.
     */
    const DUTCH_LANGUAGE_ID = 1;
    const DUTCH_LANGUAGE_CODE = 'nl';
    const DUTCH_LANGUAGE_NAME = 'Dutch';
    const DUTCH_LANGUAGE_LC_ALL_CODE = 'nl_NL';
    const DUTCH_LANGUAGE_LC_MONETARY_CODE = 'de_DE';
    const ENGLISH_LANGUAGE_ID = 2;
    const ENGLISH_LANGUAGE_CODE = 'en';
    const ENGLISH_LANGUAGE_NAME = 'English';
    const ENGLISH_LANGUAGE_LC_ALL_CODE = 'en_US.UTF-8';
    const ENGLISH_LANGUAGE_LC_MONETARY_CODE = 'en_US';

    /**
     * The current application language id.
     */
    private $language = 0;

    /**
     * Construct the languages and the translations based on it.
     *
     * @throws DuplicatedKeyException
     * @throws FileNotExistingException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function __construct()
    {
        $this->setLanguageID();
        $this->loadTranslations();
    }

    /**
     * Set the language id.
     */
    private function setLanguageID(): void
    {
        $uri = new URI();

        if (strstr($uri->getDomainExtension(), 'localhost')
            || strstr($uri->getDomainExtension(), 'nl')
        ) {
            $this->language = self::DUTCH_LANGUAGE_ID;
        } elseif (strstr($uri->getDomainExtension(), 'com')) {
            $this->language = self::ENGLISH_LANGUAGE_ID;
        }
    }

    /**
     * Get the language id.
     *
     * @return int
     */
    public function getLanguageID(): int
    {
        return $this->language;
    }

    /**
     * Load the translations based on the language id.
     *
     * @throws DuplicatedKeyException
     * @throws FileNotExistingException
     * @throws NoTranslationsForGivenLanguageID
     */
    private function loadTranslations()
    {
        if (self::DUTCH_LANGUAGE_ID === $this->getLanguageID()) {
            Config::set('languageID', self::DUTCH_LANGUAGE_ID);
            Config::set('languageCode', self::DUTCH_LANGUAGE_CODE);
            Config::set('languageName', self::DUTCH_LANGUAGE_NAME);

            setlocale(LC_ALL, self::DUTCH_LANGUAGE_LC_ALL_CODE);
            setlocale(LC_MONETARY, self::DUTCH_LANGUAGE_LC_MONETARY_CODE);

            loadFile(RESOURCES_PATH.'/language/dutch/dutch_translations.php');

            return;
        } elseif (self::ENGLISH_LANGUAGE_ID === $this->getLanguageID()) {
            Config::set('languageID', self::ENGLISH_LANGUAGE_ID);
            Config::set('languageCode', self::ENGLISH_LANGUAGE_CODE);
            Config::set('languageName', self::ENGLISH_LANGUAGE_NAME);

            setlocale(LC_ALL, self::ENGLISH_LANGUAGE_LC_ALL_CODE);
            setlocale(LC_MONETARY, self::ENGLISH_LANGUAGE_LC_MONETARY_CODE);

            loadFile(RESOURCES_PATH.'/language/english/english_translations.php');

            return;
        }

        throw new NoTranslationsForGivenLanguageID(
            'No translations where found for the given language id: '.
            $this->getLanguageID()
        );
    }
}

<?php
declare(strict_types=1);


namespace App\services\translation;


use App\services\core\Config;
use App\services\core\URI;
use Exception;

final class Builder
{
    /**
     * The dutch language options.
     */
    const DUTCH_LANGUAGE_ID = 1;
    const DUTCH_LANGUAGE_CODE = 'nl';
    const DUTCH_LANGUAGE_NAME = 'Dutch';
    const DUTCH_LANGUAGE_LC_ALL_CODE = 'nl_NL';
    const DUTCH_LANGUAGE_LC_MONETARY_CODE = 'de_DE';

    /**
     * The english language options.
     */
    const ENGLISH_LANGUAGE_ID = 2;
    const ENGLISH_LANGUAGE_CODE = 'en';
    const ENGLISH_LANGUAGE_NAME = 'English';
    const ENGLISH_LANGUAGE_LC_ALL_CODE = 'en_US.UTF-8';
    const ENGLISH_LANGUAGE_LC_MONETARY_CODE = 'en_US';

    /**
     * The current application language.
     */
    private static $language;

    /**
     * Set the language based on the domain extension.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->setLanguageID();
        if (self::DUTCH_LANGUAGE_ID === self::$language) {
            Config::set('languageID', self::DUTCH_LANGUAGE_ID);
            Config::set('languageCode', self::DUTCH_LANGUAGE_CODE);
            Config::set('languageName', self::DUTCH_LANGUAGE_NAME);

            setlocale(LC_ALL, self::DUTCH_LANGUAGE_LC_ALL_CODE);
            setlocale(LC_MONETARY, self::DUTCH_LANGUAGE_LC_MONETARY_CODE);

            loadFile(RESOURCES_PATH.'/language/dutch/dutch_translations.php');
        } elseif (self::ENGLISH_LANGUAGE_ID === self::$language) {
            Config::set('languageID', self::ENGLISH_LANGUAGE_ID);
            Config::set('languageCode', self::ENGLISH_LANGUAGE_CODE);
            Config::set('languageName', self::ENGLISH_LANGUAGE_NAME);

            setlocale(LC_ALL, self::ENGLISH_LANGUAGE_LC_ALL_CODE);
            setlocale(LC_MONETARY, self::ENGLISH_LANGUAGE_LC_MONETARY_CODE);

            loadFile(RESOURCES_PATH.'/language/english/english_translations.php');
        }
    }

    /**
     * Set the language id.
     */
    private function setLanguageID()
    {
        if (strstr(URI::getDomainExtension(), 'localhost')
            || strstr(URI::getDomainExtension(), 'nl')
        ) {
            self::$language = self::DUTCH_LANGUAGE_ID;
        } elseif (strstr(URI::getDomainExtension(), 'com')) {
            self::$language = self::ENGLISH_LANGUAGE_ID;
        }
    }

    /**
     * Get the language id.
     *
     * @return int
     */
    public static function getLanguageID()
    {
        return self::$language;
    }
}

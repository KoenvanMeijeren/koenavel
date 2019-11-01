<?php
declare(strict_types=1);


use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Translation\Translation;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{
    public function test_that_we_can_get_the_dutch_translation()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.nl';

        $this->assertNotEmpty(Translation::get('home_page_title'));
        $this->assertIsString(Translation::get('home_page_title'));
    }

    public function test_that_we_can_get_the_english_translation()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.com';

        $this->assertNotEmpty(Translation::get('home_page_title'));
        $this->assertIsString(Translation::get('home_page_title'));
    }

    public function test_that_we_cannot_load_the_translations()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.non_existing_domain';

        $this->expectException(NoTranslationsForGivenLanguageID::class);

        Translation::get('home_page_title');
    }

    public function test_that_we_cannot_get_a_translation()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.nl';

        $this->expectException(InvalidKeyException::class);

        Translation::get('testennn');
    }
}

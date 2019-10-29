<?php
declare(strict_types=1);


use App\Services\Core\Config;
use App\Services\Translation\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function test_that_we_can_build_the_dutch_translator()
    {
        $builder = new Builder();
        $builder->setLanguageSettings();
        $builder->loadTranslations();

        $this->assertEquals(
            Builder::DUTCH_LANGUAGE_ID,
            $builder->getLanguageID()
        );
    }

    public function test_that_we_can_build_the_english_translator()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.com';
        $builder = new Builder();
        $builder->setLanguageSettings();
        $builder->loadTranslations();

        $this->assertEquals(
            Builder::ENGLISH_LANGUAGE_ID,
            $builder->getLanguageID()
        );
    }

    public function test_that_we_cannot_build_the_translator()
    {
        $this->expectException(Exception::class);

        $builder = new Builder();
        $builder->loadTranslations();
    }
}

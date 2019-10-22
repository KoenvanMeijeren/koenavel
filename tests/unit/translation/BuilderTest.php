<?php
declare(strict_types=1);


use App\Services\Core\Config;
use App\Services\Translation\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function setUp(): void
    {
        Config::set(
            'encryptionToken',
            'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b'
        );
        Config::set('appName', 'TestApp');
        Config::set('env', \App\Services\Core\Env::DEVELOPMENT);
    }

    public function test_that_we_can_build_the_dutch_translator()
    {
        $builder = new Builder();
        $builder->setLanguageID();
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
        $builder->setLanguageID();
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

    public function tearDown(): void
    {
        Config::unsetAll();
    }
}

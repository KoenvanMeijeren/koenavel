<?php
declare(strict_types=1);


use App\Services\Translation\Translation;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{
    public function test_that_we_can_get_a_translation()
    {
        Translation::set('test', 'test');

        $this->assertEquals('test', Translation::get('test'));
    }

    public function test_that_we_cannot_get_a_translation()
    {
        $this->expectException(Exception::class);

        Translation::get('testennn');
    }

    public function test_that_we_cannot_set_a_duplicated_translation()
    {
        $this->expectException(Exception::class);

        Translation::set('test1', 'test');
        Translation::set('test1', 'test');
    }
}

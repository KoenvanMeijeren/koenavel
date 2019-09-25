<?php
declare(strict_types=1);


use App\services\translation\Translation;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{
    public function test_that_we_can_get_a_translation()
    {
        Translation::set('test', 'test');

        $this->assertEquals('test', Translation::get('test'));
    }
}

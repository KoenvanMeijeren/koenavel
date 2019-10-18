<?php
declare(strict_types=1);


use App\Services\Core\Sanitize;
use PHPUnit\Framework\TestCase;

class SanitizeTest extends TestCase
{
    public function test_that_we_can_trim_data()
    {
        $data = '    trim    ';
        $sanitize = new Sanitize($data);

        $this->assertNotEquals($data, $sanitize->data());
    }

    public function test_that_we_can_escape_html_from_the_data()
    {
        $data = '<script>';
        $sanitize = new Sanitize($data);

        $this->assertNotEquals($data, $sanitize->data());
    }

    public function test_that_we_can_sanitize_a_string()
    {
        $string = (string) 'test';
        $sanitizeString = new Sanitize($string);
        $this->assertEquals($string, $sanitizeString->data());
        $this->assertIsString($sanitizeString->data());
    }

    public function test_that_we_can_sanitize_an_int()
    {
        $int = (int) 1;
        $sanitizeInt = new Sanitize($int);
        $this->assertEquals($int, $sanitizeInt->data());
        $this->assertIsInt($sanitizeInt->data());
    }

    public function test_that_we_can_sanitize_a_bool()
    {
        $bool = (bool) true;
        $sanitizeBool = new Sanitize($bool);
        $this->assertEquals($bool, $sanitizeBool->data());
        $this->assertIsBool((bool) $sanitizeBool->data());
    }

    public function test_that_we_can_sanitize_a_float()
    {
        $float = (float) 15.123456;
        $sanitizeFloat = new Sanitize($float);
        $this->assertEquals($float, $sanitizeFloat->data());
        $this->assertEquals(gettype($float),gettype($sanitizeFloat->data()));
    }

    public function test_that_we_can_sanitize_a_url()
    {
        $url = '/home';
        $sanitizeUrl = new Sanitize($url, 'url');
        $this->assertNotEquals('/home', $sanitizeUrl->data());
        $this->assertIsString($sanitizeUrl->data());
    }
}

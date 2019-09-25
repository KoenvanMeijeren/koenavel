<?php
declare(strict_types=1);


use App\services\core\Sanitize;
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

    public function test_that_we_can_sanitize_data_and_it_keeps_the_same_type()
    {
        $string = 'test';
        $int = 1;
        $float = 1.5;
        $bool = true;
        $url = '/home';

        $sanitizeString = new Sanitize($string);
        $sanitizeInt = new Sanitize($int);
        $sanitizeFloat = new Sanitize($float);
        $sanitizeBool = new Sanitize($bool);
        $sanitizeUrl = new Sanitize($url, 'url');

        $this->assertEquals($string, $sanitizeString->data());
        $this->assertEquals($int, $sanitizeInt->data());
        $this->assertEquals($float, $sanitizeFloat->data());
        $this->assertEquals($bool, $sanitizeBool->data());
        $this->assertNotEquals('/home', $sanitizeUrl->data());
    }
}

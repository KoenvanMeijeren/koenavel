<?php
declare(strict_types=1);


use App\Src\validate\Validate;
use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{
    private $file = __DIR__ . '/test.file.txt';

    public function test_that_we_can_get_an_instance_of_validate()
    {
        $this->assertInstanceOf(
            Validate::class, Validate::var('test')
        );
    }

    public function test_that_we_can_pass_a_validation_check()
    {
        $this->assertInstanceOf(
            Validate::class, Validate::var('test')->isString()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var('test')->isScalar()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var(1)->isInt()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var(1.5)->isFloat()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var(1.5)->isNumeric()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var(['test'])->isCountable()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var(['test'])->isArray()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var(new stdClass())->isObject()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var('http://www.test.com')->isUrl()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var('www.test.com')->isDomain()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var('development')->isEnv()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var($this->file)->fileExists()
        );

        $this->assertInstanceOf(
            Validate::class,
            Validate::var(fopen($this->file, 'r'))->isResource()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var($this->file)->isReadable()
        );

        $this->assertInstanceOf(
            Validate::class, Validate::var($this->file)->isWritable()
        );

        $this->assertInstanceOf(
            Validate::class,
            Validate::var(new sampleTest())->methodExists('test')
        );

        $this->assertInstanceOf(
            Validate::class,
            Validate::var('test')->isCallable()
        );
    }

    public function test_that_we_can_fail_a_string_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(1)->isString();
    }

    public function test_that_we_can_fail_a_scalar_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isScalar();
    }

    public function test_that_we_can_fail_a_int_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isInt();
    }

    public function test_that_we_can_fail_a_float_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isFloat();
    }

    public function test_that_we_can_fail_a_numeric_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isNumeric();
    }

    public function test_that_we_can_fail_a_countable_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(1)->isCountable();
    }

    public function test_that_we_can_fail_an_array_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(1)->isArray();
    }

    public function test_that_we_can_fail_an_object_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isObject();
    }

    public function test_that_we_can_fail_an_url_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isUrl();
    }

    public function test_that_we_can_fail_a_domain_validation_check()
    {
        $this->expectException(Exception::class);

        Validate::var('test')->isDomain();
    }

    public function test_that_we_can_fail_an_env_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(['test'])->isEnv();
    }

    public function test_that_we_can_fail_a_file_exists_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var('test')->fileExists();
    }

    public function test_that_we_can_fail_a_readable_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var('test')->isReadable();
    }

    public function test_that_we_can_fail_a_writable_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var('test')->isWritable();
    }

    public function test_that_we_can_fail_a_method_exists_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var(new sampleTest())->methodExists('index');
    }

    public function test_that_we_can_fail_a_callable_method_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var('non_existing_method')->isCallable();
    }

    public function test_that_we_can_fail_a_resource_validation_check()
    {
        $this->expectException(Exception::class);
        Validate::var('test')->isResource();
    }
}

class sampleTest
{
    public function test()
    {
        return;
    }
}

function test() {
    return true;
}

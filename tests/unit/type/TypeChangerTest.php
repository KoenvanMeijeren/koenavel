<?php
declare(strict_types=1);


use App\services\type\TypeChanger;
use PHPUnit\Framework\TestCase;

class TypeChangerTest extends TestCase
{
    public function test_that_we_can_convert_a_string()
    {
        $typeChanger = new TypeChanger('test');
        $this->assertIsString($typeChanger->toString());
        $this->assertEquals('test', $typeChanger->toString());

        $typeChanger = new TypeChanger('<script>');
        $this->assertNotEquals('<script>', $typeChanger->toString());
    }

    public function test_that_we_cannot_convert_a_string()
    {
        $typeChanger = new TypeChanger(['array']);

        $this->expectException(Exception::class);
        $typeChanger->toString();
    }

    public function test_that_we_can_convert_a_int()
    {
        $typeChanger = new TypeChanger('1.5');
        $this->assertIsInt($typeChanger->toInt());
        $this->assertEquals(1, $typeChanger->toInt());
    }

    public function test_that_we_cannot_convert_a_int()
    {
        $typeChanger = new TypeChanger(['array']);

        $this->expectException(Exception::class);
        $typeChanger->toInt();
    }

    public function test_that_we_can_convert_a_float()
    {
        $typeChanger = new TypeChanger('1.5');
        $this->assertIsFloat($typeChanger->toFloat());
        $this->assertEquals(1.5, $typeChanger->toFloat());
    }

    public function test_that_we_cannot_convert_a_float()
    {
        $typeChanger = new TypeChanger(['array']);

        $this->expectException(Exception::class);
        $typeChanger->toFloat();
    }
}

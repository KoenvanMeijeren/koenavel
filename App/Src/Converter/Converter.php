<?php
declare(strict_types=1);


namespace App\Src\Converter;


abstract class Converter
{
    /**
     * @var mixed
     */
    protected $var;

    /**
     * @param mixed $var
     */
    public function __construct($var)
    {
        $this->var = $var;
    }

    abstract public function toReadable(): string;
}

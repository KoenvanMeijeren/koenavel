<?php
declare(strict_types=1);


namespace App\Src\Validate;

class Validator
{
    private array $input;

    /**
     * @param string[] $input
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function required(): bool
    {
    }
}

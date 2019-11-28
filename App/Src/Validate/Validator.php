<?php
declare(strict_types=1);


namespace App\Src\Validate;


class Validator
{
    /**
     * @var array
     */
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;

        dd($input);
    }

    public function required(): bool
    {

    }
}

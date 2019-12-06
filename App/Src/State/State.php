<?php
declare(strict_types=1);


namespace App\Src\State;

abstract class State
{
    /**
     * Define states to determine if loading the app was successful
     *
     * @var string
     */
    public const SUCCESSFUL = 'successful';
    public const FAILED = 'failed';
}

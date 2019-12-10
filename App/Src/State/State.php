<?php
declare(strict_types=1);


namespace App\Src\State;

abstract class State
{
    /**
     * Define states to determine if an process was successfully executed.
     *
     * @var string
     */
    public const SUCCESSFUL = 'successful';
    public const FAILED = 'failed';
    public const FORM_VALIDATION_FAILED = 'form_validation_failed';
}

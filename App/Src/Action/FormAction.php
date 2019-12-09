<?php
declare(strict_types=1);


namespace App\Src\Action;

use App\Src\Security\CSRF;

abstract class FormAction extends Action
{
    protected function authorize(): bool
    {
        if (! CSRF::validate()) {
            return false;
        }

        return true;
    }
}

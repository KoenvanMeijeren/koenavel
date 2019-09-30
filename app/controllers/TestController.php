<?php
declare(strict_types=1);


namespace App\controllers;

use App\services\core\View;

class TestController
{
    public function index()
    {
        return new View('test');
    }
}

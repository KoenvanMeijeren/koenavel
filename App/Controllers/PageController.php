<?php
declare(strict_types=1);


namespace App\Controllers;

use App\Models\Test;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class PageController
{
    public function index(): View
    {
        $title = Translation::get('home_page_title');

        return new View('index/index', compact('title'));
    }

    public function notFound(): View
    {
        $title = Translation::get('page_not_found_title');

        return new View('http/404', compact('title'));
    }

    public function test()
    {
        $user = new Test();

        $user->create([
            'test_name' => 'Test'
        ]);

        dd(
            $user,
            $user->name
        );
    }
}

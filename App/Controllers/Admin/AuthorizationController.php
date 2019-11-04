<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\User;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class AuthorizationController
{
    /**
     * The user of the app.
     *
     * @var User
     */
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): View
    {
        $title = Translation::get('login_page_title');

        return new View(
            'admin/authorization/login',
            compact('title')
        );
    }

    public function login(): Redirect
    {
        return new Redirect('/admin/inloggen');
    }

    public function logout(): Redirect
    {
        return new Redirect('/admin/uitloggen');
    }
}

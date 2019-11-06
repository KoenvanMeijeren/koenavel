<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Auth\Login;
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

    public function index()
    {
        $title = Translation::get('login_page_title');

        if ($this->user->isLoggedIn()) {
            return new Redirect('/admin/dashboard');
        }

        return new View(
            'admin/authorization/login',
            compact('title')
        );
    }

    public function login(): Redirect
    {
        $login = new Login($this->user);
        if ($login->execute()) {
            return new Redirect('/admin/dashboard');
        }

        return new Redirect('/admin');
    }

    public function logout(): Redirect
    {
        return $this->user->logout();
    }
}

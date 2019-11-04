<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Auth\AuthRoutes;
use App\Src\Response\Redirect;
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
        return new View('admin/authorization/login');
    }

    public function login(): Redirect
    {
        return new Redirect(AuthRoutes::INDEX);
    }

    public function logout(): Redirect
    {
        return new Redirect(AuthRoutes::LOGIN);
    }
}

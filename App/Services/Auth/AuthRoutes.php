<?php
declare(strict_types=1);


namespace App\Services\Auth;

use App\Controllers\Admin\AuthorizationController;
use App\Models\User;
use App\Src\Core\Router;

final class AuthRoutes
{
    /**
     * The prefix of the uri's.
     *
     * @var string
     */
    const PREFIX = 'admin';

    /**
     * The authorization uri's.
     *
     * @var string
     */
    const LOGIN = self::PREFIX.'/inloggen';
    const INDEX = self::PREFIX.'/dashboard';
    const LOGOUT = self::PREFIX.'/uitloggen';

    /**
     * Make all the authorization routes.
     */
    public static function get(): void
    {
        Router::get(
            self::LOGIN,
            AuthorizationController::class,
            'index',
            User::PUBLIC
        );

        Router::post(
            self::LOGIN,
            AuthorizationController::class,
            'login',
            User::PUBLIC
        );

        Router::get(
            self::LOGOUT,
            AuthorizationController::class,
            'logout',
            User::ADMIN
        );
    }
}

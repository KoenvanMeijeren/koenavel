<?php
declare(strict_types=1);

/*
 * Rights:
 * 0 = Accessible for everyone
 * 1 = student
 * 2 = teacher
 * 3 = Admin
 * 4 = Super admin.
 */

use App\Controllers\Admin\AuthorizationController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\PageController;
use App\Models\User;
use App\Src\Core\Router;

// Pages.
Router::get('', PageController::class,
    'index', User::PUBLIC);

/**
 * Authorization routes.
 */
Router::prefix('admin')->group(function () {
    /**
     * Authorization routes.
     */
    Router::get('inloggen', AuthorizationController::class,
        'index', User::PUBLIC);
    Router::post('inloggen', AuthorizationController::class,
        'login', User::PUBLIC);
    Router::get('uitloggen', AuthorizationController::class,
        'logout', User::ADMIN);

    /**
     * The dashboard page.
     */
    Router::get('dashboard', DashboardController::class,
        'index', User::ADMIN);
});

// Page not found.
Router::get('fourNullFour', PageController::class,
    'notFound', User::PUBLIC);

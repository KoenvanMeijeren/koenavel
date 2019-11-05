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
    'index', User::GUEST);

/**
 * Authorization routes.
 */
Router::prefix('admin')->group(function () {
    /**
     * Authorization routes.
     */
    Router::get('', AuthorizationController::class,
        'index', User::GUEST);
    Router::post('inloggen', AuthorizationController::class,
        'login', User::GUEST);
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
    'notFound', User::GUEST);

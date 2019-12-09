<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Authentication\Controllers;

use App\Http\Domain\Admin\Authentication\Actions\LogUserInAction;
use App\Http\Domain\Admin\Authentication\Actions\LogUserOutAction;
use App\Models\User;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class AuthorizationController
{
    private User $user;

    private string $redirectTo = '/admin/dashboard';
    private string $redirectBack = '/admin';

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Load the login page.
     * If the user is already logged in redirect him to the dashboard.
     *
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function index()
    {
        $title = Translation::get('login_page_title');

        if ($this->user->isLoggedIn()) {
            return new Redirect($this->redirectTo);
        }

        return new View(
            'admin/authorization/login',
            compact('title')
        );
    }

    public function login(): Redirect
    {
        $login = new LogUserInAction($this->user);
        if ($login->execute()) {
            return new Redirect($this->redirectTo);
        }

        return new Redirect($this->redirectBack);
    }

    public function logout(): Redirect
    {
        $logout = new LogUserOutAction($this->user);
        $logout->execute();

        return new Redirect($this->redirectBack);
    }
}
<?php
declare(strict_types=1);


namespace App\Controllers;

use App\Models\User;
use App\Services\Exceptions\File\FileNotFoundException;
use App\Services\View\View;

class PageController
{
    /**
     * The test model.
     *
     * @var User
     */
    private $account;

    /**
     * Construct the controller.
     */
    public function __construct()
    {
        $this->account = new User();
    }

    /**
     * Show the index page.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function index(): View
    {
        return new View('index');
    }

    /**
     * Show all cities.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function all(): View
    {
        $cities = $this->account->getAllBy();

        return new View('all', compact('cities'));
    }

    /**
     * Show one city.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function show(): View
    {
        $city = $this->account->get();

        return new View('show', compact('city'));
    }

    /**
     * Route not found.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function notFound(): View
    {
        return new View('404');
    }
}

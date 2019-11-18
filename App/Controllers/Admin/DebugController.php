<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\admin\Debug;
use App\Src\Core\Request;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class DebugController
{
    /**
     * @var Debug
     */
    private $debug;

    public function __construct()
    {
        $this->debug = new Debug();
    }

    public function index(): View
    {
        $request = new Request();
        $title = Translation::get('admin_debug_title');

        $env = $this->debug->getEnv();
        $sessionSettings = $this->debug->getSessionSettingsInformation();
        $sessionInformation = $this->debug->getSessionInformation();
        $cookieInformation = $this->debug->getCookieInformation();
        $logs = $this->debug->getLogInformation($request->get('logDate'));

        return new View(
            'admin/debug/index',
            compact(
                'title',
                'env',
                'sessionSettings',
                'sessionInformation',
                'cookieInformation',
                'logs'
            )
        );
    }
}

<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Debug\Controllers;

use App\Models\Admin\Debug;
use App\Src\Core\Request;
use App\Src\Translation\Translation;
use App\Src\View\DomainView;
use Cake\Chronos\Chronos;

final class DebugController
{
    private Debug $debug;

    private string $baseViewPath = 'Admin/Debug/Views/';

    public function __construct()
    {
        $this->debug = new Debug();
    }

    public function index(): DomainView
    {
        $request = new Request();

        $date = $request->get('logDate');
        $arrayDate = explode('-', $date);
        if (!checkdate(
            (int)($arrayDate[1] ?? 0),
            (int)($arrayDate[0] ?? 0),
            (int)($arrayDate[2] ?? 0)
        )) {
            $date = new Chronos();
            $date = $date->toDateString();
        }

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_debug_title'),
                'env' => $this->debug->getEnv(),
                'sessionSettings' => $this->debug->getSessionSettingsInformation(),
                'sessionInformation' => $this->debug->getSessionInformation(),
                'cookieInformation' => $this->debug->getCookieInformation(),
                'logs' => $this->debug->getLogInformation($date),
                'phpinfo' => $this->debug->getPHPInfo()
            ]
        );
    }
}

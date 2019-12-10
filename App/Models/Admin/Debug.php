<?php
declare(strict_types=1);


namespace App\Models\Admin;

use App\Services\Helpers\DataTable;
use App\Services\Helpers\DateTime;
use App\Src\Core\Cookie;
use App\Src\Core\Env;
use App\Src\Log\Log;
use App\Src\Session\Session;
use Cake\Chronos\Chronos;
use stdClass;

final class Debug
{
    public function getEnv(): string
    {
        $env = new Env();

        return $env->getEnv();
    }

    public function getSessionSettingsInformation(): string
    {
        $table = new DataTable();
        $session = new Session();

        $table->addHead('Sleutel', 'Waarde');
        foreach (session_get_cookie_params() as $key => $data) {
            if ($key === 'lifetime' && $session->exists('createdAt')) {
                $createdAt = new Chronos($session->get('createdAt'));
                $expiredAt = $createdAt->addSeconds($data);
                $lifetime = new Chronos();

                $table->addRow(
                    $key,
                    $lifetime->diffInMinutes($expiredAt) . ' minuten'
                );
            } elseif (is_bool($data)) {
                $table->addRow($key, $data ? 'true' : 'false');
            } else {
                $table->addRow(
                    $key,
                    $data
                );
            }
        }

        return $table->get();
    }

    public function getSessionInformation(): string
    {
        $session = new Session();
        $table = new DataTable();

        $table->addHead('Sleutel', 'Waarde');
        foreach ($_SESSION as $key => $data) {
            if ($key === 'CSRF') {
                continue;
            }

            if ($key === 'createdAt') {
                $dateTime = new DateTime(new Chronos($session->get($key)));

                $table->addRow(
                    $key,
                    $dateTime->toDateTime()
                );
            } else {
                $table->addRow(
                    $key,
                    $session->get($key)
                );
            }
        }

        return $table->get();
    }

    public function getCookieInformation(): string
    {
        $cookie = new Cookie();
        $table = new DataTable();

        $table->addHead('Sleutel', 'Waarde');
        foreach ($_COOKIE as $key => $data) {
            if ($key === 'sessionName' || $key === 'websiteID') {
                continue;
            }

            if ($key === $cookie->get('sessionName')
                && $cookie->exists($cookie->get('sessionName'))
            ) {
                $table->addRow(
                    'sessie cookie',
                    $_COOKIE[$cookie->get('sessionName')]
                );
            } else {
                $table->addRow(
                    $key,
                    $cookie->get($key)
                );
            }
        }

        return $table->get();
    }

    /**
     * Get information from the logs.
     *
     * @param string $date
     *
     * @return string[]
     */
    public function getLogInformation(string $date): array
    {
        $chronos = new Chronos($date);
        $logs = (array) preg_split(
            '/(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}])/',
            Log::get($chronos->toDateString())
        );
        unset($logs[array_key_first($logs)]);

        array_walk($logs, static function (&$value) {
            if (preg_match_all(
                '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}|(?<=]).*(?={)|{.*}/',
                $value,
                $matches,
                PREG_PATTERN_ORDER
            ) !== false) {
                $matches = $matches[0] ?? [];
                $matches[2] = isJson($matches[2] ?? '') ? json_decode(
                    $matches[2],
                    false,
                    512,
                    JSON_THROW_ON_ERROR
                ) : [];
            }

            $date = new DateTime(new Chronos($matches[0] ?? ''));
            $title = explode('on line', $matches[1] ?? '');
            $value = [
                'date' => ucfirst($date->toDateTime()),
                'title' => $title[0] ?? 'undefined',
                'message' => $matches[1] ?? 'undefined',
                'meta' => $matches[2] ?? new stdClass()
            ];
        });

        return array_reverse($logs);
    }

    public function getPHPInfo(): string
    {
        ob_start();

        phpinfo();

        $phpinfo = (string) ob_get_clean();

        return preg_replace(
            '%^.*<body>(.*)</body>.*$%ms',
            '$1',
            $phpinfo
        );
    }
}

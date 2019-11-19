<?php
declare(strict_types=1);


namespace App\Models\admin;

use App\Services\Helpers\DataTable;
use App\Services\Helpers\DateTime;
use App\Src\Core\Cookie;
use App\Src\Core\Env;
use App\Src\Log\Log;
use App\Src\Session\Session;
use Cake\Chronos\Chronos;

final class Debug
{
    public function getEnv(): string
    {
        $env = new Env();

        return $env->getEnv();
    }

    public function getSessionSettingsInformation(): string
    {
        $table = new DataTable('sessionSettings');
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
            } elseif ($data === false) {
                $table->addRow($key, 'false');
            } elseif ($data === true) {
                $table->addRow($key, 'true');
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
        $table = new DataTable('sessionInfo');

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
        $table = new DataTable('cookieInfo');

        $table->addHead('Sleutel', 'Waarde');
        foreach ($_COOKIE as $key => $data) {
            if ($key === 'sessionName' || $key === 'websiteID') {
                continue;
            }

            if ($cookie->exists($cookie->get('sessionName'))
                && $key === $cookie->get('sessionName')
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
        $date = new Chronos($date);
        $logs = preg_split(
            '/(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\])/',
            Log::get($date->toDateString())
        );

        if ($logs !== false) {
            unset($logs[array_key_first($logs)]);
        }

        array_walk($logs, function (&$value, $key) {
            if (preg_match_all(
                '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}|(?<=\]).*(?=\{)|{.*}/',
                $value,
                $matches,
                PREG_PATTERN_ORDER
            )
            ) {
                $matches = $matches[0] ?? [];
                $matches[2] = isJson($matches[2] ?? '') ? json_decode($matches[2]) : [];
            }

            $date = new DateTime(new Chronos($matches[0] ?? ''));
            $title = explode('on line', $matches[1] ?? '');
            $value = [
                'date' => ucfirst($date->toDateTime()),
                'title' => $title[0] ?? 'undefined',
                'message' => $matches[1] ?? 'undefined',
                'meta' => $matches[2] ?? new \stdClass()
            ];
        });

        return $logs !== false ? array_reverse($logs) : [];
    }
}

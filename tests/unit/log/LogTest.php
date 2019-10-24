<?php
declare(strict_types=1);


use App\Services\Core\Config;
use App\Services\Log\Log;
use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    /**
     * The logger
     *
     * @var Log
     */
    private $log;

    public function setUp(): void
    {
        Config::set('appName', 'TestApp');
        Config::set('env', \App\Services\Core\Env::DEVELOPMENT);

        $this->log = new Log();
    }

    public function test_that_we_can_log_info_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = $this->log->get($chronos->toDateString());
        $this->log->info('Test that we can log info');
        $logDataAfter = $this->log->get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_log_error_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = $this->log->get($chronos->toDateString());
        $this->log->error('Test that we can log error info');
        $logDataAfter = $this->log->get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_get_log_data()
    {
        $chronos =  new Chronos();

        $this->assertIsString($this->log->get($chronos->toDateString()));
    }

    public function tearDown(): void
    {
        Config::unset('appName');
        Config::unset('env');
    }
}

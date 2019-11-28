<?php
declare(strict_types=1);


use App\Src\Log\Log;
use Cake\Chronos\Chronos;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    public function test_that_we_can_log_debug_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = Log::get($chronos->toDateString());
        Log::debug('Test that we can debug info');
        $logDataAfter = Log::get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_log_info_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = Log::get($chronos->toDateString());
        Log::info('Test that we can log info');
        $logDataAfter = Log::get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_log_warning_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = Log::get($chronos->toDateString());
        Log::warning('Test that we can log info');
        $logDataAfter = Log::get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_log_error_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = Log::get($chronos->toDateString());
        Log::error('Test that we can log error info');
        $logDataAfter = Log::get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_get_log_data()
    {
        $chronos =  new Chronos();

        $this->assertIsString(Log::get($chronos->toDateString()));
    }
}

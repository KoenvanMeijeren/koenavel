<?php
declare(strict_types=1);


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
        $this->log = new Log();
    }

    public function test_that_we_can_log_info_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = $this->log->get($chronos->toDateString());
        $this->log->addInfo('Test that we can log info');
        $logDataAfter = $this->log->get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_log_error_data()
    {
        $chronos =  new Chronos();

        $logDataBefore = $this->log->get($chronos->toDateString());
        $this->log->addError('Test that we can log error info');
        $logDataAfter = $this->log->get($chronos->toDateString());

        $this->assertNotEquals($logDataBefore, $logDataAfter);
    }

    public function test_that_we_can_get_log_data()
    {
        $chronos =  new Chronos();

        $this->assertIsString($this->log->get($chronos->toDateString()));
    }
}

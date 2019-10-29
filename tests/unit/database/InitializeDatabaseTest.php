<?php
declare(strict_types=1);


use App\Services\Config\ConfigLoader;
use App\Services\Database\DatabaseProcessor;
use App\Services\Exceptions\Basic\InvalidKeyException;

class InitializeDatabaseTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $env = new \App\Services\Core\Env();
        $config = new ConfigLoader($env->getEnv());
        $config->load();
    }

    public function test_that_we_cannot_initialize_the_database_without_config()
    {
        $this->expectException(InvalidKeyException::class);

        \App\Services\Core\Config::unsetAll();
        new DatabaseProcessor('test', []);
    }

    public function test_that_we_cannot_execute_an_invalid_self_written_query()
    {
        $this->expectException(PDOException::class);

        \App\Services\Database\DB::table('test')
            ->query('test')
            ->execute()
            ->all();
    }

    public function test_that_we_cannot_execute_an_invalid_build_query()
    {
        $this->expectException(PDOException::class);

        \App\Services\Database\DB::table('test')
            ->select('test')
            ->select('test')
            ->execute()
            ->all();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        \App\Services\Core\Config::unsetAll();
    }
}

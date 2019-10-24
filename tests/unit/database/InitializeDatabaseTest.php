<?php
declare(strict_types=1);


use App\Services\Database\DatabaseProcessor;
use App\Services\Exceptions\Basic\EmptyVarException;
use App\Services\Exceptions\Basic\InvalidKeyException;

class InitializeDatabaseTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $env = new \App\Services\Core\Env();
        $env->setEnv();
    }

    public function test_that_we_cannot_initialize_the_database_without_config()
    {
        $this->expectException(InvalidKeyException::class);

        \App\Services\Core\Config::unsetAll();
        new DatabaseProcessor('test', []);
    }

    public function test_that_we_cannot_execute_an_empty_query_via_processor()
    {
        $this->expectException(EmptyVarException::class);

        new DatabaseProcessor('', []);
    }

    public function test_that_we_cannot_execute_an_empty_query_via_builder()
    {
        $this->expectException(EmptyVarException::class);

        \App\Services\Database\DB::table('test')
            ->query('')
            ->execute()
            ->all();
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

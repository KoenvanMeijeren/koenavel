<?php
declare(strict_types=1);


class InitializeDatabaseTest extends \PHPUnit\Framework\TestCase
{
    public function test_that_we_cannot_execute_an_invalid_self_written_query()
    {
        $this->expectException(PDOException::class);

        \App\Services\Database\DB::table('account')
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
}

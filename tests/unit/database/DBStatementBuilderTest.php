<?php
declare(strict_types=1);


class DBStatementBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function test_that_we_can_build_a_self_written_query()
    {
        $this->assertEquals(
            "SELECT * FROM test",
            \App\Services\Database\DB::table('test')
                ->query("SELECT * FROM test")->getQuery()
        );
    }

    public function test_that_we_can_build_the_select_statement()
    {
        $this->assertEquals(
            "SELECT * FROM test ",
            \App\Services\Database\DB::table('test')
                ->select('*')->getQuery()
        );

        $this->assertEquals(
            "SELECT test1, test2 FROM test ",
            \App\Services\Database\DB::table('test')
                ->select('test1', 'test2')->getQuery()
        );
    }
}

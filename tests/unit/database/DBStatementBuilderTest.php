<?php
declare(strict_types=1);


use App\Services\Database\DB;

class DBStatementBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function test_that_we_can_build_the_select_statement()
    {
        $this->assertEquals(
            "SELECT * FROM test ",
            DB::table('test')
                ->select('*')->getQuery()
        );

        $this->assertEquals(
            "SELECT test1, test2 FROM test ",
            DB::table('test')
                ->select('test1', 'test2')->getQuery()
        );
    }

    public function test_that_we_can_build_the_union_select_statement()
    {
        $this->assertEquals(
            'SELECT Code FROM country UNION SELECT CountryCode FROM  countrylanguage',
            DB::table('country')
                ->select('Code')
                ->selectUnion('countrylanguage', 'CountryCode')
                ->getQuery()
        );
    }
}

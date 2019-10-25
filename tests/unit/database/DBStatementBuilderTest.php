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

    public function test_that_we_can_build_the_union_all_select_statement()
    {
        $this->assertEquals(
            'SELECT Code FROM country UNION ALL SELECT CountryCode FROM  countrylanguage',
            DB::table('country')
                ->select('Code')
                ->selectUnionAll('countrylanguage', 'CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_the_distinct_select_statement()
    {
        $this->assertEquals(
            'SELECT DISTINCT Code FROM country ',
            DB::table('country')
                ->selectDistinct('Code')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_the_min_select_statement()
    {
        $this->assertEquals(
            'SELECT MIN(population) FROM country ',
            DB::table('country')
                ->selectMin('population')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_the_max_select_statement()
    {
        $this->assertEquals(
            'SELECT MAX(population) FROM country ',
            DB::table('country')
                ->selectMax('population')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_the_count_select_statement()
    {
        $this->assertEquals(
            'SELECT COUNT(population) FROM country ',
            DB::table('country')
                ->selectCount('population')
                ->getQuery()
        );
    }


}

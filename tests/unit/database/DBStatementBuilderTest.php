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
            'SELECT Code FROM country UNION SELECT CountryCode FROM countrylanguage',
            DB::table('country')
                ->select('Code')
                ->selectUnion('countrylanguage', 'CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_the_union_all_select_statement()
    {
        $this->assertEquals(
            'SELECT Code FROM country UNION ALL SELECT CountryCode FROM countrylanguage',
            DB::table('country')
                ->select('Code')
                ->selectUnionAll('countrylanguage',
                    'CountryCode')
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

    public function test_that_we_can_build_the_avg_select_statement()
    {
        $this->assertEquals(
            'SELECT AVG(population) FROM country ',
            DB::table('country')
                ->selectAvg('population')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_the_sum_select_statement()
    {
        $this->assertEquals(
            'SELECT SUM(population) FROM country ',
            DB::table('country')
                ->selectSum('population')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_a_single_inner_join_statement()
    {
        $this->assertEquals(
            'SELECT * FROM  country INNER JOIN countryLanguage ON country.Code = countryLanguage.CountryCode ',
            DB::table('country')
                ->select('*')
                ->innerJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_multiple_inner_join_statements()
    {
        $this->assertEquals(
            'SELECT * FROM (( country INNER JOIN countryLanguage ON country.Code = countryLanguage.CountryCode) INNER JOIN city ON country.Code = city.CountryCode) ',
            DB::table('country')
                ->select('*')
                ->innerJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->innerJoin('city',
                    'country.Code',
                    'city.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_a_left_inner_join_statement()
    {
        $this->assertEquals(
            'SELECT * FROM  country LEFT JOIN countryLanguage ON country.Code = countryLanguage.CountryCode ',
            DB::table('country')
                ->select('*')
                ->leftJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_multiple_left_join_statements()
    {
        $this->assertEquals(
            'SELECT * FROM (( country LEFT JOIN countryLanguage ON country.Code = countryLanguage.CountryCode) LEFT JOIN city ON country.Code = city.CountryCode) ',
            DB::table('country')
                ->select('*')
                ->leftJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->leftJoin('city',
                    'country.Code',
                    'city.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_a_single_right_join_statement()
    {
        $this->assertEquals(
            'SELECT * FROM  country RIGHT JOIN countryLanguage ON country.Code = countryLanguage.CountryCode ',
            DB::table('country')
                ->select('*')
                ->rightJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_multiple_right_join_statements()
    {
        $this->assertEquals(
            'SELECT * FROM (( country RIGHT JOIN countryLanguage ON country.Code = countryLanguage.CountryCode) RIGHT JOIN city ON country.Code = city.CountryCode) ',
            DB::table('country')
                ->select('*')
                ->rightJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->rightJoin('city',
                    'country.Code',
                    'city.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_a_single_full_outer_join_statement()
    {
        $this->assertEquals(
            'SELECT * FROM  country FULL OUTER JOIN countryLanguage ON country.Code = countryLanguage.CountryCode ',
            DB::table('country')
                ->select('*')
                ->fullOuterJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->getQuery()
        );
    }

    public function test_that_we_can_build_multiple_full_outer_join_statements()
    {
        $this->assertEquals(
            'SELECT * FROM (( country FULL OUTER JOIN countryLanguage ON country.Code = countryLanguage.CountryCode) FULL OUTER JOIN city ON country.Code = city.CountryCode) ',
            DB::table('country')
                ->select('*')
                ->fullOuterJoin("countryLanguage",
                    'country.Code',
                    'countryLanguage.CountryCode')
                ->fullOuterJoin('city',
                    'country.Code',
                    'city.CountryCode')
                ->getQuery()
        );
    }
}

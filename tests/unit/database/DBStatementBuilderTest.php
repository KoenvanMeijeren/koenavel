<?php
declare(strict_types=1);


use App\Src\Database\DB;

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

    public function test_that_we_can_get_the_values()
    {
        $values = DB::table('city')
            ->select('*')
            ->where('CountryCode', '=', 'NLD')
            ->getValues();

        $this->assertIsArray($values);
        $this->assertNotEmpty($values);
        $this->assertArrayHasKey('CountryCode', $values);
        $this->assertEquals('NLD', $values['CountryCode']);
    }

    public function test_that_we_can_add_the_where_statement()
    {
        $this->assertEquals(
            'SELECT * FROM city WHERE CountryCode = :CountryCode ',
            DB::table('city')
                ->select('*')
                ->where('CountryCode', '=', 'NLD')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_multiple_where_statements()
    {
        $this->assertEquals(
            'SELECT * FROM city WHERE CountryCode = :CountryCode AND Population > :Population ',
            DB::table('city')
                ->select('*')
                ->where('CountryCode', '=', 'NLD')
                ->where('Population', '>', '122000')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_exists_statement()
    {
        $this->assertEquals(
            'SELECT * FROM countryLanguage WHERE EXISTS (SELECT * FROM country WHERE IndepYear >= :IndepYear ) ',
            DB::table('countryLanguage')
                ->select('*')
                ->whereExists(
                    DB::table('country')
                        ->select('*')
                        ->where(
                            'IndepYear', '>=', '1900'
                        )->getQuery(),
                    DB::table('country')
                        ->select('*')
                        ->where(
                            'IndepYear', '>=', '1900'
                        )->getValues()
                )
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_any_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Code = ANY (SELECT Code FROM countryLanguage WHERE Code = :Code ) ',
            DB::table('country')
                ->select('*')
                ->whereAny('Code','=',
                    DB::table('countryLanguage')
                        ->select('Code')
                        ->where('Code', '=', 'ABW')
                        ->getQuery(),
                    DB::table('countryLanguage')
                        ->select('Code')
                        ->where('Code', '=', 'ABW')
                        ->getValues()
                )
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_all_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Code = ALL (SELECT Code FROM countryLanguage WHERE Code = :Code ) ',
            DB::table('country')
                ->select('*')
                ->whereAll('Code','=',
                    DB::table('countryLanguage')
                        ->select('Code')
                        ->where('Code', '=', 'ABW')
                        ->getQuery(),
                    DB::table('countryLanguage')
                        ->select('Code')
                        ->where('Code', '=', 'ABW')
                        ->getValues()
                )
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_not_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE NOT Code = :Code ',
            DB::table('country')
                ->select('*')
                ->whereNot('Code', '=', 'ABW')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_is_null_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE IndepYear IS NULL ',
            DB::table('country')
                ->select('*')
                ->whereIsNull('IndepYear')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_is_not_null_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE IndepYear IS NOT NULL ',
            DB::table('country')
                ->select('*')
                ->whereIsNotNull('IndepYear')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_in_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Code IN (:Code0, :Code1, :Code2) ',
            DB::table('country')
                ->select('*')
                ->whereInValue('Code', 'ABW', 'AFG', 'AGO')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_not_in_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Code NOT IN (:Code0, :Code1, :Code2) ',
            DB::table('country')
                ->select('*')
                ->whereNotInValue('Code', 'ABW', 'AFG', 'AGO')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_or_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Region = :Region0 OR Region = :Region1 OR Region = :Region2 ',
            DB::table('country')
                ->select('*')
                ->whereOr('Region',
                    'Carribbean', 'Central America', 'North America')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_or_statement_with_an_existing_where_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Continent = :Continent AND ( Region = :Region0 OR Region = :Region1 OR Region = :Region2 )',
            DB::table('country')
                ->select('*')
                ->where('Continent',
                    '=', 'North America')
                ->whereOr('Region',
                    'Carribbean', 'Central America', 'North America')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_in_query_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Code IN (SELECT CountryCode FROM countryLanguage WHERE CountryCode = :CountryCode ) ',
            DB::table('country')
                ->select('*')
                ->whereInQuery(
                    'Code',
                    DB::table('countryLanguage')
                        ->select('CountryCode')
                        ->where('CountryCode', '=', 'ABW')
                        ->getQuery(),
                    DB::table('countryLanguage')
                        ->select('CountryCode')
                        ->where('CountryCode', '=', 'ABW')
                        ->getValues()
                )
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_between_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE  Population BETWEEN :PopulationStart AND :PopulationEnd ',
            DB::table('country')
                ->select('*')
                ->whereBetween('Population', '0', '10000')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_not_between_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE  Population NOT BETWEEN :PopulationStart AND :PopulationEnd ',
            DB::table('country')
                ->select('*')
                ->whereNotBetween('Population', '0', '10000')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_where_or_between_statement()
    {
        $this->assertEquals(
            'SELECT * FROM country WHERE Code = :Code OR Population BETWEEN :PopulationStart AND :PopulationEnd ',
            DB::table('country')
                ->select('*')
                ->where('Code', '=', 'ABW')
                ->whereOrBetween('Population', '0', '500000')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_having_statement()
    {
        $this->assertEquals(
            'SELECT COUNT(Continent), Region FROM country HAVING COUNT(Continent) > 5 ',
            DB::table('country')
                ->select('COUNT(Continent), Region')
                ->having('COUNT(Continent) > 5')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_update_statement()
    {
        $this->assertEquals(
            'UPDATE city SET Name = :Name, CountryCode = :CountryCode, District = :District, Population = :Population WHERE ID = :ID ',
            DB::table('city')
                ->update([
                    'Name' => 'Harderwijk',
                    'CountryCode' => 'NLD',
                    'District' => 'Gelderland',
                    'Population' => '50000'
                ])
                ->where('ID', '=', '4080')
                ->getQuery()
        );

        $values = DB::table('city')
            ->update([
                'Name' => 'Harderwijk',
                'CountryCode' => 'NLD',
                'District' => 'Gelderland',
                'Population' => '50000'
            ])
            ->where('ID', '=', '4080')
            ->getValues();

        $this->assertArrayHasKey('Name', $values);
        $this->assertArrayHasKey('CountryCode', $values);
        $this->assertArrayHasKey('District', $values);
        $this->assertArrayHasKey('Population', $values);
        $this->assertArrayHasKey('ID', $values);
    }

    public function test_that_we_can_soft_delete_a_record()
    {
        $this->assertEquals(
            'UPDATE city SET Is_deleted = :Is_deleted WHERE ID = :ID ',
            DB::table('city')
                ->delete('Is_deleted')
                ->where('ID', '=', '4080')
                ->getQuery()
        );

        $values = DB::table('city')
            ->delete('Is_deleted')
            ->where('ID', '=', '4080')
            ->getValues();

        $this->assertArrayHasKey('Is_deleted', $values);
        $this->assertArrayHasKey('ID', $values);

        $this->assertEquals('4080', $values['ID']);
    }

    public function test_that_we_can_permanent_delete_a_record()
    {
        $this->assertEquals(
            'DELETE FROM city WHERE ID = :ID ',
            DB::table('city')
                ->permanentDelete()
                ->where('ID', '=', '4080')
                ->getQuery()
        );

        $values = DB::table('city')
            ->permanentDelete()
            ->where('ID', '=', '4080')
            ->getValues();

        $this->assertArrayHasKey('ID', $values);

        $this->assertEquals('4080', $values['ID']);
    }

    public function test_that_we_can_add_the_order_by_statement()
    {
        $this->assertEquals(
            'SELECT * FROM city ORDER BY Name DESC ',
            DB::table('city')
                ->select('*')
                ->orderBy('DESC', 'Name')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_group_by_statement()
    {
        $this->assertEquals(
            'SELECT * FROM city GROUP BY Name ',
            DB::table('city')
                ->select('*')
                ->groupBy('Name')
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_limit_statement()
    {
        $this->assertEquals(
            'SELECT * FROM city LIMIT 10 ',
            DB::table('city')
                ->select('*')
                ->limit(10)
                ->getQuery()
        );
    }

    public function test_that_we_can_add_the_group_by_and_order_by_and_limit_statements()
    {
        $this->assertEquals(
            'SELECT COUNT(CountryCode), CountryCode FROM city GROUP BY CountryCode ORDER BY COUNT(CountryCode) DESC LIMIT 10 ',
            DB::table('city')
                ->select('COUNT(CountryCode)', 'CountryCode')
                ->groupBy('CountryCode')
                ->orderBy('DESC', 'COUNT(CountryCode)')
                ->limit(10)
                ->getQuery()
        );
    }

    public function test_that_we_can_add_a_self_written_statement_with_values()
    {
        $this->assertEquals(
            'SELECT * FROM test WHERE test = :test',
            DB::table('test')
                ->select('*')
                ->addStatementWithValues(
                    'WHERE test = :test', ['test' => 1]
                )
                ->getQuery()
        );

        $values = DB::table('test')
            ->select('*')
            ->addStatementWithValues(
                'WHERE test = :test', ['test' => 1]
            )
            ->getValues();

        $this->assertArrayHasKey('test', $values);
        $this->assertContains(1, $values);
    }

    public function test_that_we_can_add_a_self_written_statement_with_values_when_the_statement_already_contains_a_where_statement()
    {
        $this->assertEquals(
            'SELECT * FROM test WHERE city = :city AND test = :test',
            DB::table('test')
                ->select('*')
                ->where('city', '=', '2')
                ->addStatementWithValues(
                    'WHERE test = :test', ['test' => 1]
                )
                ->getQuery()
        );

        $values = DB::table('test')
            ->select('*')
            ->where('city', '=', '2')
            ->addStatementWithValues(
                'WHERE test = :test', ['test' => 1]
            )
            ->getValues();

        $this->assertArrayHasKey('test', $values);
        $this->assertArrayHasKey('city', $values);
        $this->assertContains(1, $values);
        $this->assertContains(2, $values);
    }
}

<?php
declare(strict_types=1);

use App\Services\Core\Config;

class DBOutputTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Config::set('databaseName', 'test');
        Config::set('databaseUsername', 'root');
        Config::set('databasePassword', 'koenvanmeijeren');
        Config::set('databaseServer', 'mysql:host=localhost');
        Config::set('databasePort', '3306');
        Config::set('databaseCharset', 'utf8');
        Config::set('databaseOptions',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public function test_that_we_can_get_one_result()
    {
        $result = \App\Services\Database\DB::table('testtable')
            ->select('*')
            ->execute()
            ->firstToArray();

        $this->assertArrayHasKey('ID', $result);
        $this->assertArrayHasKey('idtestTable', $result);
    }

    public function test_that_we_can_get_multiple_result()
    {
        $result = \App\Services\Database\DB::table('testtable')
            ->select('*')
            ->execute()
            ->toArray();

        $this->assertNotCount(1, $result);

        // it is an multi dimension array
        // so it should not contain an id on the first layer
        $this->assertArrayNotHasKey('ID', $result);
        // now it should contain an id on the second layer
        $this->assertArrayHasKey('ID', $result[0]);
    }

    public function test_that_we_can_get_a_result_from_a_self_written_query()
    {
        $result = \App\Services\Database\DB::table('not_necessary')
            ->query('SELECT * FROM city')
            ->execute()
            ->all();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_that_we_can_get_a_result_from_a_select_query()
    {
        $resultA = \App\Services\Database\DB::table('city')
            ->select('*')
            ->execute()
            ->first();

        $this->assertIsObject($resultA);
        $this->assertNotEmpty($resultA);
        $this->assertObjectHasAttribute('Population', $resultA);

        $resultB = \App\Services\Database\DB::table('city')
            ->select('ID', 'Name')
            ->execute()
            ->first();

        $this->assertIsObject($resultB);
        $this->assertNotEmpty($resultB);

        $this->assertNotEquals($resultA, $resultB);
        $this->assertObjectHasAttribute('ID', $resultB);
        $this->assertObjectNotHasAttribute(
            'Population', $resultB);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Config::unsetAll();
    }
}

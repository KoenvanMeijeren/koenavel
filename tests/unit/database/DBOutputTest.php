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

    public function test_that_we_can_get_a_result_from_a_self_written_query()
    {
        $result = \App\Services\Database\DB::table('not_necessary')
            ->query('SELECT * FROM city')
            ->execute()
            ->all();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }


    public function tearDown(): void
    {
        parent::tearDown();

        Config::unsetAll();
    }
}

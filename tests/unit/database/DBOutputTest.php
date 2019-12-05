<?php
declare(strict_types=1);


class DBOutputTest extends \PHPUnit\Framework\TestCase
{
    public function test_that_we_can_get_one_result()
    {
        $result = \App\Src\Database\DB::table('account')
            ->select('*')
            ->execute()
            ->firstToArray();

        $this->assertArrayHasKey('account_ID', $result);
    }

    public function test_that_we_can_get_multiple_result()
    {
        $result = \App\Src\Database\DB::table('account')
            ->select('*')
            ->execute()
            ->allToArray();

        $this->assertNotCount(1, $result);

        // it is an multi dimension array
        // so it should not contain an id on the first layer
        $this->assertArrayNotHasKey('account_ID', $result);
        // now it should contain an id on the second layer
        $this->assertArrayHasKey('account_ID', $result[0]);
    }

    public function test_that_we_can_get_a_result_from_a_self_written_query()
    {
        $result = \App\Src\Database\DB::query(
            'SELECT * FROM account'
        )->all();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_that_we_can_get_a_result_from_a_select_query()
    {
        $resultA = \App\Src\Database\DB::table('account')
            ->select('*')
            ->execute()
            ->first();

        $this->assertIsObject($resultA);
        $this->assertNotEmpty($resultA);
        $this->assertObjectHasAttribute('account_ID', $resultA);

        $resultB = \App\Src\Database\DB::table('account')
            ->select('account_ID', 'account_name')
            ->execute()
            ->first();

        $this->assertIsObject($resultB);
        $this->assertNotEmpty($resultB);

        $this->assertNotEquals($resultA, $resultB);
        $this->assertObjectHasAttribute('account_ID', $resultB);
        $this->assertObjectNotHasAttribute(
            'account_email', $resultB);
    }

    public function test_that_we_can_fetch_a_result_in_your_own_way()
    {
        $result = \App\Src\Database\DB::table('account')
            ->select('*')
            ->execute()
            ->fetch(PDO::FETCH_NAMED);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('account_ID', $result);
    }

    public function test_that_we_can_fetch_all_a_result_in_your_own_way()
    {
        $result = \App\Src\Database\DB::table('account')
            ->select('*')
            ->execute()
            ->fetchAll(PDO::FETCH_NAMED);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('account_ID', $result[0]);
    }

    public function test_that_we_can_get_the_last_inserted_id()
    {
        $processor = new \App\Src\Database\DatabaseProcessor(
            'SELECT * FROM account', []
        );
        $id = $processor->getLastInsertedId();

        $this->assertIsInt($id);
    }
}

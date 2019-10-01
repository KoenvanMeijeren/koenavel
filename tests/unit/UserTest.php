<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        $this->user = new \App\models\User;
    }

    public function test_that_we_can_get_the_first_name()
    {
        $this->user->setFirstName('Billy');

        $this->assertEquals($this->user->getFirstName(), 'Billy');
    }

    public function test_that_we_can_get_the_last_name()
    {
        $this->user->setLastName('Garret');

        $this->assertEquals($this->user->getLastName(), 'Garret');
    }

    public function test_full_name_is_returned()
    {
        $this->user->setFirstName('Billy');
        $this->user->setLastName('Garret');

        $this->assertEquals($this->user->getFullName(), 'Billy Garret');
    }

    public function test_that_first_and_last_name_are_trimmed()
    {
        $this->user->setFirstName(' Billy     ');
        $this->user->setLastName('         Garret   ');

        $this->assertEquals($this->user->getFirstName(), 'Billy');
        $this->assertEquals($this->user->getLastName(), 'Garret');
    }

    public function test_email_address_can_be_set()
    {
        $this->user->setEmail('billy@gmail.com');

        $this->assertEquals($this->user->getEmail(), 'billy@gmail.com');
    }

    public function test_email_variables_contain_correct_values()
    {
        $this->user->setFirstName('Billy');
        $this->user->setLastName('Garret');
        $this->user->setEmail('billy@codecourse.com');

        $emailVariables = $this->user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Billy Garret');
        $this->assertEquals($emailVariables['email'], 'billy@codecourse.com');
    }
}

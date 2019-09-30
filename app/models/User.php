<?php
declare(strict_types=1);


namespace App\model;

class User
{
    private $firstName;
    private $lastName;
    private $email;

    public function setFirstName(string $name)
    {
        $this->firstName = trim($name);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName(string $name)
    {
        $this->lastName = trim($name);
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFullName()
    {
        return "$this->firstName $this->lastName";
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEmailVariables()
    {
        return [
            'full_name' => $this->getFullName(),
            'email' => $this->getEmail()
        ];
    }
}

<?php
namespace ExampleApp;


class User implements IUser {
    protected $firstName;
    protected $lastName;
    protected $phone;
    protected $email;

    public function __construct(string $firstName, string $lastName, string $email, string $phone = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->getLastName;
    }

    public function getEmail(): string {
        return $this->email;
    }
    
    public function getPhone(): string {
        return $this->phone;
    }

    
}
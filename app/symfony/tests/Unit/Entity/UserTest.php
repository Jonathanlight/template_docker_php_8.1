<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testEmail()
    {
        $email = 'test@example.com';
        $this->user->setEmail($email);
        $this->assertEquals($email, $this->user->getEmail());
    }

    public function testRoles()
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        $this->user->setRoles($roles);
        $this->assertEquals($roles, $this->user->getRoles());
    }

    public function testPassword()
    {
        $password = 'password';
        $this->user->setPassword($password);
        $this->assertEquals($password, $this->user->getPassword());
    }

    public function testFullname()
    {
        $fullname = 'John Doe';
        $this->user->setFullname($fullname);
        $this->assertEquals($fullname, $this->user->getFullname());
    }
}
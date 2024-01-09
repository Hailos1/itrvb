<?php

namespace UnitTests\Model;

use Model\Name;
use Model\User;
use Model\UUID;
use PHPUnit\Framework\TestCase;

class UserTests extends TestCase
{
    public function testGetData(): void {
        $uuid = UUID::random();
        $username = 'username';
        $name = new Name('fN', 'lN');
        $user = new User($uuid, $username, $name);

        $this->assertEquals($uuid, $user->getUuid());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($name, $user->getName());
    }
}
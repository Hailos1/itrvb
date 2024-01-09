<?php

namespace UnitTests\Model;

use Model\Name;
use Model\Person;
use PHPUnit\Framework\TestCase;

class PersonTests extends TestCase
{
    public function testToString(): void {
        $name = new Name('fN', 'lN');
        $date = new \DateTimeImmutable('now');
        $person = new Person($name, $date);

        $this->assertEquals("fN lN (на сайте с " . $date->format('Y-m-d') . ')',
            $person);
    }
}
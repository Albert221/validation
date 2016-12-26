<?php

namespace Albert221\Validation\Rule;

use PDO;

class PDOUniqueTest extends \PHPUnit_Framework_TestCase
{
    public function testNonExistingValue()
    {
        $rule = new PDOUnique('test', 'name', $this->getPDO());

        $this->assertTrue($rule->test('test'));
    }

    public function testExistingValue()
    {
        $rule = new PDOUnique('test', 'name', $this->getPDO());

        $this->assertFalse($rule->test('foobar'));
    }

    private function getPDO()
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->exec('CREATE TABLE IF NOT EXISTS test (id int, name varchar)');
        $pdo->exec('INSERT INTO test (name) VALUES ("foobar")');

        return $pdo;
    }
}

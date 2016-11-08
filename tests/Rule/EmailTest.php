<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class EmailTest extends PHPUnit_Framework_TestCase
{
    public function testWithValidEmail()
    {
        $rule = new Email();

        $this->assertTrue($rule->test('example@example.com'));
    }

    public function testWithInvalidEmail()
    {
        $rule = new Email();

        $this->assertFalse($rule->test('test'));
    }
}

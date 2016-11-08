<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class RequiredTest extends PHPUnit_Framework_TestCase
{
    public function testWithPassingValue()
    {
        $rule = new Required();

        $this->assertTrue($rule->test('test'));
    }

    public function testWithZeroString()
    {
        $rule = new Required();

        $this->assertTrue($rule->test('0'));
    }

    public function testWithFalse()
    {
        $rule = new Required();

        $this->assertTrue($rule->test(false));
    }

    public function testWithNull()
    {
        $rule = new Required();

        $this->assertFalse($rule->test(null));
    }

    public function testWithEmptyString()
    {
        $rule = new Required();

        $this->assertFalse($rule->test(''));
    }

    public function testWithEmptyArray()
    {
        $rule = new Required();

        $this->assertFalse($rule->test([]));
    }
}

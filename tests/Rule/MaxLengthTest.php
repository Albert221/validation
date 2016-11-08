<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class MaxLengthTest extends PHPUnit_Framework_TestCase
{
    public function testSmallerLength()
    {
        $rule = new MaxLength(5);

        $this->assertTrue($rule->test('test'));
    }

    public function testEqualLength()
    {
        $rule = new MaxLength(5);

        $this->assertTrue($rule->test('test1'));
    }

    public function testGreaterLength()
    {
        $rule = new MaxLength(5);

        $this->assertFalse($rule->test('test12'));
    }
}

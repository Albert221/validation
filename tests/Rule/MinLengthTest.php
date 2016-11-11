<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class MinLengthTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonIntegerArgument()
    {
        new MinLength('test');
    }

    public function testSmallerLength()
    {
        $rule = new MinLength(5);

        $this->assertFalse($rule->test('test'));
    }

    public function testEqualLength()
    {
        $rule = new MinLength(5);

        $this->assertTrue($rule->test('test1'));
    }

    public function testGreaterLength()
    {
        $rule = new MinLength(5);

        $this->assertTrue($rule->test('test12'));
    }
}

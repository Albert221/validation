<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class LengthTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonInteger()
    {
        new Length('test');
    }

    public function testSmallerLength()
    {
        $rule = new Length(5);

        $this->assertFalse($rule->test('test'));
    }

    public function testExactLength()
    {
        $rule = new Length(5);

        $this->assertTrue($rule->test('test1'));
    }

    public function testGreaterLength()
    {
        $rule = new Length(5);

        $this->assertFalse($rule->test('test12'));
    }
}

<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class LengthTest extends PHPUnit_Framework_TestCase
{
    public function testSmallerLength()
    {
        $rule = new Length(5, 7);

        $this->assertFalse($rule->test('test'));
    }

    public function testMinimumLength()
    {
        $rule = new Length(5, 7);

        $this->assertTrue($rule->test('test1'));
    }

    public function testLengthBetween()
    {
        $rule = new Length(5, 7);

        $this->assertTrue($rule->test('test12'));
    }

    public function testMaximumLength()
    {
        $rule = new Length(5, 7);

        $this->assertTrue($rule->test('test123'));
    }

    public function testGreaterLength()
    {
        $rule = new Length(5, 7);

        $this->assertFalse($rule->test('test1234'));
    }
}

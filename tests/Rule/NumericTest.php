<?php

namespace Albert221\Validation\Rule;

class NumericTest extends \PHPUnit_Framework_TestCase
{
    public function testOnlyDigits()
    {
        $rule = new Numeric();

        $this->assertTrue($rule->test('1234567890'));
    }

    public function testWithLetter()
    {
        $rule = new Numeric();

        $this->assertFalse($rule->test('12345a67890'));
    }

    public function testWithSpace()
    {
        $rule = new Numeric();

        $this->assertFalse($rule->test('123 4567890'));
    }

    public function testWithSpecialCharacter()
    {
        $rule = new Numeric();

        $this->assertFalse($rule->test('123!4567890'));
    }
}

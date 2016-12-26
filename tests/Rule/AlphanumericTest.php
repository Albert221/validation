<?php

namespace Albert221\Validation\Rule;

class AlphanumericTest extends \PHPUnit_Framework_TestCase
{
    public function testWithLettersAndDigits()
    {
        $rule = new Alphanumeric();

        $this->assertTrue($rule->test('4AbcD32SE321F'));
    }

    public function testWithSpecialCharacters()
    {
        $rule = new Alphanumeric();

        $this->assertFalse($rule->test('test@'));
    }
}

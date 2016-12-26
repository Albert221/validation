<?php

namespace Albert221\Validation\Rule;

class UnicodeAlphanumericTest extends \PHPUnit_Framework_TestCase
{
    public function testWithLettersAndDigits()
    {
        $rule = new UnicodeAlphanumeric();

        $this->assertTrue($rule->test('4AbcD32SE321F'));
    }

    public function testWithUnicodeLetters()
    {
        $rule = new UnicodeAlphanumeric();

        $this->assertTrue($rule->test('Zażółćgęśląjaźń'));
    }

    public function testWithSpecialCharacters()
    {
        $rule = new UnicodeAlphanumeric();

        $this->assertFalse($rule->test('test@'));
    }
}

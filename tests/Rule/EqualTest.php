<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class EqualTest extends PHPUnit_Framework_TestCase
{
    public function testWithEqualValues()
    {
        $rule = new Equal('test');

        $this->assertTrue($rule->test('test'));
    }

    public function testWithNotEqualValues()
    {
        $rule = new Equal('yes');

        $this->assertFalse($rule->test('test'));
    }
}

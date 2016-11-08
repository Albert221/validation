<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class RegexTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWithInvalidRegex()
    {
        $rule = new Regex('[');
    }

    public function testWithPassingValue()
    {
        $rule = new Regex('/^\w+$/');

        $this->assertTrue($rule->test('test'));
    }

    public function testWithFailingValue()
    {
        $rule = new Regex('/^\w+$/');

        $this->assertFalse($rule->test('te st'));
    }
}

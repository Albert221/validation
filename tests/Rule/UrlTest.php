<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class UrlTest extends PHPUnit_Framework_TestCase
{
    public function testAgainstValidUrl()
    {
        $rule = new Url();

        $this->assertTrue($rule->test('http://test:test@www.example.com:2556/index.html?test=ok#test'));
    }

    public function testAgainstInvalidUrl()
    {
        $rule = new Url();

        $this->assertFalse($rule->test('test'));
    }
}

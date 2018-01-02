<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testVerdict()
    {
        $validator = new RegexValidator();

        // Passes
        $this->assertTrue($validator->verdict(null, new Regex(['pattern' => '/^\d$/']))->passes());
        $this->assertTrue($validator->verdict('0', new Regex(['pattern' => '/^\d$/']))->passes());
        $this->assertTrue($validator->verdict('7', new Regex(['pattern' => '/^\d$/']))->passes());
        $this->assertTrue($validator->verdict('foobar', new Regex(['pattern' => '/^\w+$/']))->passes());
        $this->assertTrue($validator->verdict('', new Regex(['pattern' => '/^$/']))->passes());

        // Fails
        $this->assertFalse($validator->verdict('', new Regex(['pattern' => '/^\d$/']))->passes());
        $this->assertFalse($validator->verdict('a', new Regex(['pattern' => '/^\d$/']))->passes());
        $this->assertFalse($validator->verdict(' ', new Regex(['pattern' => '/^\d$/']))->passes());
        $this->assertFalse($validator->verdict('foo bar', new Regex(['pattern' => '/^\w+$/']))->passes());
        $this->assertFalse($validator->verdict('something', new Regex(['pattern' => '/^$/']))->passes());
    }
}

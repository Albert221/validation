<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testVerdict()
    {
        $urlValidator = new UrlValidator();

        // Passes
        $this->assertTrue($urlValidator->verdict('http://google.com', new Url())->passes());
        $this->assertTrue($urlValidator->verdict('http://github.com/Albert221/validation', new Url())->passes());
        $this->assertTrue($urlValidator->verdict('http://google.com:1212?foo=bar', new Url())->passes());

        // Fails
        $this->assertFalse($urlValidator->verdict('foobar', new Url())->passes());
        $this->assertFalse($urlValidator->verdict('google.com', new Url())->passes()); // Missing scheme
    }
}

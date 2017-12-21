<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use PHPUnit\Framework\TestCase;

class RequiredTest extends TestCase
{
    public function testVerdict()
    {
        $requiredValidator = new RequiredValidator();

        // Passes
        $this->assertTrue($requiredValidator->verdict('', new Required())->passes());
        $this->assertTrue($requiredValidator->verdict('foobar', new Required())->passes());
        $this->assertTrue($requiredValidator->verdict([], new Required())->passes());
        $this->assertTrue($requiredValidator->verdict(false, new Required())->passes());
        $this->assertTrue($requiredValidator->verdict(0, new Required())->passes());

        // Fails
        $this->assertFalse($requiredValidator->verdict(null, new Required())->passes());
    }
}

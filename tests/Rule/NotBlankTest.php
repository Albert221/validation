<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use PHPUnit\Framework\TestCase;

class NotBlankTest extends TestCase
{
    public function testVerdict()
    {
        $notBlankValidator = new NotBlankValidator();

        // Passes
        $this->assertTrue($notBlankValidator->verdict(null, new NotBlank())->passes());
        $this->assertTrue($notBlankValidator->verdict('foobar', new NotBlank())->passes());
        $this->assertTrue($notBlankValidator->verdict(['foo' => 'bar'], new NotBlank())->passes());
        $this->assertTrue($notBlankValidator->verdict(false, new NotBlank())->passes());
        $this->assertTrue($notBlankValidator->verdict(0, new NotBlank())->passes());

        // Fails
        $this->assertFalse($notBlankValidator->verdict('', new NotBlank())->passes());
        $this->assertFalse($notBlankValidator->verdict([], new NotBlank())->passes());
    }
}

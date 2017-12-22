<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * Thanks to https://en.wikipedia.org/wiki/Email_address#Examples
     */
    public function testVerdict()
    {
        $emailValidator = new EmailValidator();

        // Passes
        $this->assertTrue($emailValidator->verdict(null, new Email())->passes());
        $this->assertTrue($emailValidator->verdict('prettyandsimple@example.com', new Email())->passes());
        $this->assertTrue($emailValidator->verdict('very.common@example.com', new Email())->passes());
        $this->assertTrue($emailValidator->verdict('disposable.email.with+symbol@example.com', new Email())->passes());
        $this->assertTrue($emailValidator->verdict('other.email-with-dash@example.com', new Email())->passes());
        $this->assertTrue($emailValidator->verdict('fully-qualified-domain@example.com', new Email())->passes());
        $this->assertTrue($emailValidator->verdict('user.name+tag+sorting@example.com', new Email())->passes());
        $this->assertTrue($emailValidator->verdict('x@example.com', new Email())->passes());

        // Fails
        $this->assertFalse($emailValidator->verdict('Abc.example.com', new Email())->passes());
        $this->assertFalse($emailValidator->verdict('A@b@c@example.com', new Email())->passes());
        $this->assertFalse($emailValidator->verdict('a"b(c)d,e:f;g<h>i[j\k]l@example.com', new Email())->passes());
        $this->assertFalse($emailValidator->verdict('this is"not\allowed@example.com', new Email())->passes());
    }
}

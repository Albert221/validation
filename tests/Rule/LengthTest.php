<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class LengthTest extends TestCase
{
    public function testMinLengthVerdict()
    {
        $validator = new LengthValidator();
        $rule = new Length(['min' => 3]);

        // Passes
        $this->assertTrue($validator->verdict(null, $rule)->passes());
        $this->assertTrue($validator->verdict('foo', $rule)->passes());
        $this->assertTrue($validator->verdict('foobar', $rule)->passes());

        // Fails
        $this->assertFalse($validator->verdict('', $rule)->passes());
        $this->assertFalse($validator->verdict('ab', $rule)->passes());
    }

    public function testMaxLengthVerdict()
    {
        $validator = new LengthValidator();
        $rule = new Length(['max' => 5]);

        // Passes
        $this->assertTrue($validator->verdict(null, $rule)->passes());
        $this->assertTrue($validator->verdict('', $rule)->passes());
        $this->assertTrue($validator->verdict('foo', $rule)->passes());
        $this->assertTrue($validator->verdict('fooba', $rule)->passes());

        // Fails
        $this->assertFalse($validator->verdict('foobar', $rule)->passes());
        $this->assertFalse($validator->verdict('foobarbaz', $rule)->passes());
    }

    public function testMinMaxLengthVerdict()
    {
        $validator = new LengthValidator();
        $rule = new Length(['min' => 3, 'max' => 6]);

        // Passes
        $this->assertTrue($validator->verdict(null, $rule)->passes());
        $this->assertTrue($validator->verdict('foo', $rule)->passes());
        $this->assertTrue($validator->verdict('foob', $rule)->passes());
        $this->assertTrue($validator->verdict('foobar', $rule)->passes());

        // Fails
        $this->assertFalse($validator->verdict('', $rule)->passes());
        $this->assertFalse($validator->verdict('ab', $rule)->passes());
        $this->assertFalse($validator->verdict('foobarbaz', $rule)->passes());
    }

    public function testExactLengthVerdict()
    {
        $validator = new LengthValidator();
        $rule = new Length(['exact' => 3]);

        // Passes
        $this->assertTrue($validator->verdict(null, $rule)->passes());
        $this->assertTrue($validator->verdict('foo', $rule)->passes());

        // Fails
        $this->assertFalse($validator->verdict('', $rule)->passes());
        $this->assertFalse($validator->verdict('ab', $rule)->passes());
        $this->assertFalse($validator->verdict('foobar', $rule)->passes());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage If "exact" option has been passed, no other options must be passed.
     */
    public function testThrowsExceptionWhenNotOnlyExactPassed()
    {
        $validator = new LengthValidator();
        $validator->verdict(null, new Length(['min' => 3, 'exact' => 4]));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Value of "max" option must be bigger than value of "min" option.
     */
    public function testThrowsExceptionWhenMinBiggerThanMax()
    {
        $validator = new LengthValidator();
        $validator->verdict(null, new Length(['min' => 10, 'max' => 5]));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Value of "min" and "max" must not be the same. Use "exact" option instead.
     */
    public function testThrowsExceptionWhenMinAndMaxAreSame()
    {
        $validator = new LengthValidator();
        $validator->verdict(null, new Length(['min' => 5, 'max' => 5]));
    }
}

<?php

namespace Albert221\Validation\Rule;

class MinLength implements RuleInterface
{
    use RuleTrait;

    protected $message = 'This field does not exceed minimum length.';
    protected $minLength;

    public function __construct($minLength)
    {
        if (! is_int($minLength)) {
            throw new \InvalidArgumentException(
                sprintf('Minimum length must be type of int, %s given.', gettype($minLength))
            );
        }

        $this->minLength = $minLength;
    }

    public function test($value)
    {
        return mb_strlen($value) >= $this->minLength;
    }
}

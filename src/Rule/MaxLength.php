<?php

namespace Albert221\Validation\Rule;

class MaxLength implements RuleInterface
{
    use RuleTrait;

    protected $maxLength;

    public function __construct($maxLength)
    {
        $this->message = 'This field exceeds maximum length.';

        if (! is_int($maxLength)) {
            throw new \InvalidArgumentException(
                sprintf('Maximum length must be type of int, %s given.', gettype($maxLength))
            );
        }

        $this->maxLength = $maxLength;
    }

    public function test($value)
    {
        return mb_strlen($value) <= $this->maxLength;
    }
}

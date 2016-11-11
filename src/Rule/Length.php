<?php

namespace Albert221\Validation\Rule;

class Length implements RuleInterface
{
    use RuleTrait;

    protected $minLength;
    protected $maxLength;

    public function __construct($minLength, $maxLength)
    {
        $this->message = 'This field does not meet the permitted length.';

        if (! is_int($minLength)) {
            throw new \InvalidArgumentException(
                sprintf('Minimum length must be type of int, %s given.', gettype($minLength))
            );
        }

        if (! is_int($maxLength)) {
            throw new \InvalidArgumentException(
                sprintf('Maximum length must be type of int, %s given.', gettype($maxLength))
            );
        }

        if ($minLength > $maxLength) {
            throw new \InvalidArgumentException('Minimum length must not be greater than maximum length.');
        }

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function test($value)
    {
        return mb_strlen($value) >= $this->minLength && mb_strlen($value) <= $this->maxLength;
    }
}

<?php

namespace Albert221\Validation\Rule;

class Length implements RuleInterface
{
    use RuleTrait;

    protected $length;

    public function __construct($length)
    {
        $this->message = 'This field is not the proper length.';

        if (! is_int($length)) {
            throw new \InvalidArgumentException(
                sprintf('Minimum length must be type of int, %s given.', gettype($length))
            );
        }

        $this->length = $length;
    }

    public function test($value)
    {
        return mb_strlen($value) == $this->length;
    }
}

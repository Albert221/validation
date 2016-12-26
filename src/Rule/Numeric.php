<?php

namespace Albert221\Validation\Rule;

class Numeric implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'This field must consist only of numeric characters.';
    }

    public function test($value)
    {
        return ctype_digit($value);
    }
}
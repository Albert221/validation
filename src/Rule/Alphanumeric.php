<?php

namespace Albert221\Validation\Rule;

class Alphanumeric implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'This field must consist only of alphanumeric characters.';
    }

    public function test($value)
    {
        return (bool)preg_match('/^[A-Za-z0-9]+$/', $value);
    }
}
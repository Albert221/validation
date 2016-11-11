<?php

namespace Albert221\Validation\Rule;

class Email implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'This field should contain valid email address.';
    }

    public function test($value)
    {
        return (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}

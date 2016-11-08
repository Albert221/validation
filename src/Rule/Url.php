<?php

namespace Albert221\Validation\Rule;

class Url implements RuleInterface
{
    use RuleTrait;

    protected $message = 'This field must be a valid url.';

    public function test($value)
    {
        return (bool)filter_var($value, FILTER_VALIDATE_URL);
    }
}
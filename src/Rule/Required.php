<?php

namespace Albert221\Validation\Rule;

class Required implements RuleInterface
{
    use RuleTrait;

    public function __construct()
    {
        $this->message = 'This field is required.';
    }

    public function test($value)
    {
        return false === $value || '0' === $value || !empty($value);
    }
}

<?php

namespace Albert221\Validation\Rule;

class UnicodeAlphanumeric extends Alphanumeric implements RuleInterface
{
    public function test($value)
    {
        return (bool)preg_match('/^[\pL0-9]+$/u', $value);
    }
}

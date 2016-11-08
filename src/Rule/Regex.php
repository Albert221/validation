<?php

namespace Albert221\Validation\Rule;

class Regex implements RuleInterface
{
    use RuleTrait;

    protected $message = 'This field must follow specified pattern.';
    protected $pattern;

    public function __construct($pattern)
    {
        if (false === @preg_match($pattern, null)) {
            throw new \InvalidArgumentException(sprintf('Invalid regular pattern, %s given.', $pattern));
        }

        $this->pattern = $pattern;
    }

    public function test($value)
    {
        return (bool)preg_match($this->pattern, $value);
    }
}

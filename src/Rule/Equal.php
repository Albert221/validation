<?php

namespace Albert221\Validation\Rule;

class Equal implements RuleInterface
{
    use RuleTrait;

    protected $message = 'This field should be equal to the specified value.';
    protected $twin;

    public function __construct($twin)
    {
        $this->twin = $twin;
    }

    public function test($value)
    {
        return $this->twin === $value;
    }
}
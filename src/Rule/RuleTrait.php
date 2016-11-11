<?php

namespace Albert221\Validation\Rule;

trait RuleTrait
{
    protected $message;

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}

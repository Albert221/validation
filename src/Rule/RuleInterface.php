<?php

namespace Albert221\Validation\Rule;

interface RuleInterface
{
    /**
     * Returns the message of failure with validating.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Sets the message of failure with validating.
     *
     * @param string $message
     */
    public function setMessage($message);

    /**
     * Returns if value passes the test correctly.
     *
     * @param mixed $value
     * @return bool
     */
    public function test($value);
}

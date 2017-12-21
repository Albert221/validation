<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;

/**
 * Validated whether given value is a given email address.
 */
class Email extends Rule
{
    protected $message = 'This field must be a valid email address.';
}

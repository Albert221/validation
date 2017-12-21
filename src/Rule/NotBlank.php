<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;

/**
 * Validates whether given value is blank or not.
 */
class NotBlank extends Rule
{
    protected $message = 'This field must not be blank.';
}

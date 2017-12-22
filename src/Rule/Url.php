<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;

/**
 * Validates whether given value is a valid URL or not.
 */
class Url extends Rule
{
    protected $message = 'This field must be a valid URL.';
}

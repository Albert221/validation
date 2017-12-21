<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;

/**
 * Validates whether given value actually exists or not.
 */
class Required extends Rule
{
    protected $message = 'This field is required.';
}

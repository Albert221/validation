<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;

/**
 * Checks whether given value is of proper length.
 */
class Length extends Rule
{
    protected $message = 'This field must be the proper length.';
}

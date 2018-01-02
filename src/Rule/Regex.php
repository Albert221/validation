<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;

/**
 * Checks whether given value matches given regex.
 */
class Regex extends Rule
{
    protected $message = 'This field must follow given pattern.';
}

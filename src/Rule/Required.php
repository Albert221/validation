<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;

/**
 * Required validates whether given value is considered as existing or not.
 */
class Required extends Rule
{
    protected $message = 'This field is required.';
}

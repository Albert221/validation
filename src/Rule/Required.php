<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Verdict;

/**
 * Required validates whether given value is considered as existing or not.
 */
class Required extends Rule
{
    protected $message = 'This field is required.';

    /**
     * {@inheritdoc}
     */
    public function verdict($value): Verdict
    {
        $passes = false;

        if (null !== $value) {
            $passes = true;
        }

        return Verdict::create($passes, $this);
    }
}

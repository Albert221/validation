<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;
use Albert221\Validation\RuleValidator;
use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;

class EmailValidator extends RuleValidator
{
    /**
     * {@inheritdoc}
     */
    public function verdict($value, Rule $rule): VerdictInterface
    {
        if (is_null($value)) {
            return Verdict::create(true, $rule);
        }

        return Verdict::create(
            (bool) filter_var($value, FILTER_VALIDATE_EMAIL),
            $rule
        );
    }
}

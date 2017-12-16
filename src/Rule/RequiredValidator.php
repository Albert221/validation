<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;

class RequiredValidator extends RuleValidator
{
    /**
     * {@inheritdoc}
     */
    public function verdict($value, Rule $rule): VerdictInterface
    {
        if (null !== $value) {
            return Verdict::create(true, $rule);
        }

        return Verdict::create(false, $rule);
    }
}

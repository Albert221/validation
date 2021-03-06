<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;
use Albert221\Validation\RuleValidator;
use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;

class NotBlankValidator extends RuleValidator
{
    /**
     * {@inheritdoc}
     */
    public function verdict($value, Rule $rule): VerdictInterface
    {
        if (is_null($value)) {
            return Verdict::passing($rule);
        }

        return Verdict::create(
            !empty($value)
                || $value === "0"
                || $value === 0
                || $value === false,
            $rule
        );
    }
}

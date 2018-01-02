<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;
use Albert221\Validation\RuleValidator;
use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;
use InvalidArgumentException;

class RegexValidator extends RuleValidator
{
    public function verdict($value, Rule $rule): VerdictInterface
    {
        $this->validateOptions($rule->getOptions());

        if (is_null($value)) {
            return Verdict::passing($rule);
        }

        return Verdict::create(
            1 === preg_match($rule->getOption('pattern'), $value),
            $rule
        );
    }

    /**
     * @param array $options
     */
    private function validateOptions(array $options): void
    {
        if (!array_key_exists('pattern', $options)) {
            throw new InvalidArgumentException('"pattern" option is required.');
        }
    }
}

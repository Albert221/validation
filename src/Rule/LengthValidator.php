<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Rule;
use Albert221\Validation\RuleValidator;
use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;
use InvalidArgumentException;

class LengthValidator extends RuleValidator
{
    public function verdict($value, Rule $rule): VerdictInterface
    {
        $this->validateOptions($rule->getOptions());

        if (is_null($value)) {
            return Verdict::passing($rule);
        }

        return Verdict::create(
            $this->isNotSmallerThanItShould($value, $rule)
                && $this->isNotBiggerThanItShould($value, $rule)
                && $this->isExactlyHowItShould($value, $rule),
            $rule
        );
    }

    /**
     * @param $value
     * @param Rule $rule
     *
     * @return bool
     */
    private function isNotSmallerThanItShould($value, Rule $rule): bool
    {
        return mb_strlen($value) >= $rule->getOption('min', 0);
    }

    /**
     * @param $value
     * @param Rule $rule
     *
     * @return bool
     */
    private function isNotBiggerThanItShould($value, Rule $rule): bool
    {
        return mb_strlen($value) <= $rule->getOption('max', PHP_INT_MAX);
    }

    /**
     * @param $value
     * @param Rule $rule
     *
     * @return bool
     */
    private function isExactlyHowItShould($value, Rule $rule): bool
    {
        return is_null($rule->getOption('exact'))
            || mb_strlen($value) === $rule->getOption('exact');
    }

    /**
     * @param array $options
     */
    private function validateOptions(array $options)
    {
        if (isset($options['min']) && isset($options['max'])) {
            if ($options['min'] == $options['max']) {
                throw new InvalidArgumentException(
                    'Value of "min" and "max" must not be the same. Use "exact" option instead.'
                );
            }

            if ($options['min'] > $options['max']) {
                throw new InvalidArgumentException(
                    'Value of "max" option must be bigger than value of "min" option.'
                );
            }
        }

        if ((isset($options['min']) || isset($options['max'])) && isset($options['exact'])) {
            throw new InvalidArgumentException(
                'If "exact" option has been passed, no other options must be passed.'
            );
        }
    }
}

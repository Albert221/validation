<?php

declare(strict_types=1);

namespace Albert221\Validation;

class RuleValidatorFactory
{
    /**
     * @param Rule $rule
     *
     * @return RuleValidator
     */
    public function getInstance(Rule $rule): RuleValidator
    {
        $validatorName = $rule->validatedBy();

        return new $validatorName();
    }
}

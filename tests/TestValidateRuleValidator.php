<?php

declare(strict_types=1);

namespace Albert221\Validation;

class TestValidateRuleValidator extends RuleValidator
{
    public static $called = false;
    public function verdict($value, Rule $rule): VerdictInterface
    {
        self::$called = true;
        return Verdict::create(true, $rule);
    }
}

<?php

declare(strict_types=1);

namespace Albert221\Validation;

use Albert221\Validation\Rule\Rule;

class Verdict
{
    /**
     * @var bool
     */
    private $passes;

    /**
     * @var Rule
     */
    private $rule;

    /**
     * @var Field
     */
    private $field;

    /**
     * @param bool $passes
     * @param Rule $rule
     *
     * @return Verdict
     */
    public static function create(bool $passes, Rule $rule)
    {
        return new self($passes, $rule, $rule->getField());
    }

    /**
     * Verdict constructor.
     *
     * @param bool $passes
     * @param Rule $rule
     * @param Field $field
     */
    public function __construct(bool $passes, Rule $rule, Field $field)
    {
        $this->passes = $passes;
        $this->rule = $rule;
        $this->field = $field;
    }

    /**
     * @return bool
     */
    public function passes(): bool
    {
        return $this->passes;
    }

    /**
     * @return Field
     */
    public function getField(): Field
    {
        return $this->field;
    }
}

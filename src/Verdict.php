<?php

declare(strict_types=1);

namespace Albert221\Validation;

class Verdict implements VerdictInterface
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
     * @var Field|null
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
     * @param Field|null $field
     */
    public function __construct(bool $passes, Rule $rule, ?Field $field)
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
     * @return Field|null
     */
    public function getField(): ?Field
    {
        return $this->field;
    }
}

<?php

declare(strict_types=1);

namespace Albert221\Validation;

class ValidationState
{
    /**
     * @var VerdictList
     */
    private $verdicts;

    /**
     * ValidationState constructor.
     *
     * @param array $verdicts
     */
    public function __construct(array $verdicts)
    {
        $this->verdicts = new VerdictList($verdicts);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return 0 === count($this->verdicts->failing());
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isFieldValid(string $name): bool
    {
        $verdictsForField = $this->verdicts->forField($name);
        if (0 === $verdictsForField->count()) {
            throw new \InvalidArgumentException(sprintf(
                'Field "%s" does not exist in the validation state.',
                $name
            ));
        }

        return 0 === $verdictsForField->failing()->count();
    }

    /**
     * @return VerdictList
     */
    public function all(): VerdictList
    {
        return $this->verdicts;
    }

    /**
     * @param string $name
     *
     * @return VerdictList
     */
    public function field(string $name): VerdictList
    {
        return $this->verdicts->forField($name);
    }
}

<?php

declare(strict_types=1);

namespace Albert221\Validation;

use ArrayAccess;
use OutOfBoundsException;
use OutOfRangeException;

class ValidationState implements ArrayAccess
{
    const FLAT = 0;
    const GROUPED = 1;

    /**
     * @var Verdicts
     */
    private $verdicts;

    /**
     * ValidationState constructor.
     *
     * @param array $verdicts
     */
    public function __construct(array $verdicts)
    {
        $this->verdicts = new Verdicts($verdicts);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return count($this->verdicts->failing()) === 0;
    }

    /**
     * @param int $strategy
     *
     * @return Verdict[]
     */
    public function all(): array
    {
        return $this->verdicts->toArray();
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isFieldValid(string $name): bool
    {
        $verdictsForField = $this->verdicts->forField($name);
        if ($verdictsForField->count() === 0) {
            throw new \InvalidArgumentException(sprintf(
                'Field "%s" does not exist in the validation state.',
                $name
            ));
        }

        return $verdictsForField->failing()->count === 0;
    }

    /**
     * @param string $name
     *
     * @return Verdict[]
     */
    public function field(string $name): array
    {
        return $this->verdicts->forField($name)->toArray();
    }

    /**
     * @param int|string $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        if (is_int($offset)) {
            return isset($this->verdicts->toArray()[$offset]);
        }

        if (!is_string($offset)) {
            throw new OutOfRangeException(sprintf(
                'Offset should be an integer index for FLAT strategy or string for GROUPED, %s given.',
                is_scalar($offset) ? gettype($offset): get_class($offset)
            ));
        }

        return $this->verdicts->forField($offset)->count() > 0;
    }

    /**
     * @param int|string $offset
     *
     * @return array
     */
    public function offsetGet($offset): array
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfBoundsException(sprintf(
                'Item with offset "%s" does not exist.',
                $offset
            ));
        }

        if (is_int($offset)) {
            return $this->all()[$offset];
        }

        return $this->field($offset);
    }

    public function offsetSet($offset, $value)
    {
        // You cannot set any value.
    }

    public function offsetUnset($offset)
    {
        // You cannot unset any value.
    }
}

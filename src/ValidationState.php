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
     * @var Verdict[]
     */
    private $verdicts;

    /**
     * ValidationState constructor.
     *
     * @param array $verdicts
     */
    public function __construct(array $verdicts)
    {
        $this->verdicts = $verdicts;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        foreach ($this->verdicts as $verdict) {
            if (!$verdict->passes()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $strategy
     *
     * @return Verdict[]
     */
    public function all(int $strategy = self::FLAT): array
    {
        if (self::FLAT === $strategy) {
            return $this->verdicts;
        }

        $array = [];
        foreach ($this->verdicts as $verdict) {
            $array[$verdict->getField()->getName()] = $verdict;
        }

        return $array;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isFieldValid(string $name): bool
    {
        $doesExist = false;
        foreach ($this->verdicts as $verdict) {
            if ($name !== $verdict->getField()->getName()) {
                continue;
            }

            $doesExist = true;

            if (!$verdict->passes()) {
                return false;
            }
        }

        if (!$doesExist) {
            throw new \InvalidArgumentException(sprintf(
                'Field with name "%s" does not exist.',
                $name
            ));
        }

        return true;
    }

    /**
     * @param string $name
     *
     * @return Verdict[]
     */
    public function field(string $name): array
    {
        $verdicts = [];
        foreach ($this->verdicts as $verdict) {
            if ($name === $verdict->getField()->getName()) {
                $verdicts[] = $verdict;
            }
        }

        return $verdicts;
    }

    /**
     * @param int|string $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        if (is_int($offset)) {
            return isset($this->verdicts[$offset]);
        }

        if (!is_string($offset)) {
            throw new OutOfRangeException(sprintf(
                'Offset should be an integer index for FLAT strategy or string for GROUPED, %s given.',
                is_scalar($offset) ? gettype($offset): get_class($offset)
            ));
        }

        foreach ($this->verdicts as $verdict) {
            if ($offset === $verdict->getField()->getName()) {
                return true;
            }
        }

        return false;
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

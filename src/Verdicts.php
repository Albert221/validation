<?php

declare(strict_types=1);

namespace Albert221\Validation;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class Verdicts implements Countable, IteratorAggregate
{
    /**
     * @var Verdict[]
     */
    private $verdicts;

    /**
     * Verdicts constructor.
     *
     * @param Verdict[] $verdicts
     */
    public function __construct(array $verdicts)
    {
        $this->verdicts = $verdicts;
    }

    /**
     * @return Verdicts
     */
    public function passing(): Verdicts
    {
        return $this->filter(function (Verdict $verdict) {
            return $verdict->passes();
        });
    }

    /**
     * @return Verdicts
     */
    public function failing(): Verdicts
    {
        return $this->filter(function (Verdict $verdict) {
            return !$verdict->passes();
        });
    }

    /**
     * @param string $fieldName
     *
     * @return Verdicts
     */
    public function forField(string $fieldName): Verdicts
    {
        return $this->filter(function (Verdict $verdict) use ($fieldName) {
            return $verdict->getField()->getName() === $fieldName;
        });
    }

    /**
     * @param callable $function
     *
     * @return Verdicts
     */
    public function map(callable $function): Verdicts
    {
        return new static(array_map($function, $this->verdicts));
    }

    /**
     * @param callable $function
     *
     * @return Verdicts
     */
    public function filter(callable $function): Verdicts
    {
        return new static(array_filter($this->verdicts, $function));
    }

    /**
     * @param callable $function
     * @param mixed $initial
     *
     * @return Verdicts
     */
    public function reduce(callable $function, $initial = null): Verdicts
    {
        return new static(array_reduce($this->verdicts, $function, $initial));
    }

    /**
     * @return Verdict[]
     */
    public function toArray(): array
    {
        return $this->verdicts;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->verdicts);
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->verdicts);
    }
}

<?php

declare(strict_types=1);

namespace Albert221\Validation;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class VerdictList implements Countable, IteratorAggregate
{
    /**
     * @var VerdictInterface[]
     */
    private $verdicts;

    /**
     * Verdicts constructor.
     *
     * @param VerdictInterface[] $verdicts
     */
    public function __construct(array $verdicts)
    {
        $this->verdicts = $verdicts;
    }

    /**
     * @return bool
     */
    public function pass(): bool
    {
        return count($this->failing()) === 0;
    }

    /**
     * @return bool
     */
    public function fail(): bool
    {
        return count($this->failing()) > 0;
    }

    /**
     * @return VerdictList
     */
    public function passing(): VerdictList
    {
        return $this->filter(function (VerdictInterface $verdict) {
            return $verdict->passes();
        });
    }

    /**
     * @return VerdictList
     */
    public function failing(): VerdictList
    {
        return $this->filter(function (VerdictInterface $verdict) {
            return !$verdict->passes();
        });
    }

    /**
     * @param string $fieldName
     *
     * @return VerdictList
     */
    public function forField(string $fieldName): VerdictList
    {
        return $this->filter(function (VerdictInterface $verdict) use ($fieldName) {
            return $verdict->getField()->getName() === $fieldName;
        });
    }

    /**
     * @param callable $function
     *
     * @return VerdictList
     */
    public function map(callable $function): VerdictList
    {
        return new static(array_map($function, $this->verdicts));
    }

    /**
     * @param callable $function
     *
     * @return VerdictList
     */
    public function filter(callable $function): VerdictList
    {
        return new static(array_filter($this->verdicts, $function));
    }

    /**
     * @param callable $function
     * @param mixed $initial
     *
     * @return VerdictList
     */
    public function reduce(callable $function, $initial = null): VerdictList
    {
        return new static(array_reduce($this->verdicts, $function, $initial));
    }

    /**
     * @return VerdictInterface[]
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

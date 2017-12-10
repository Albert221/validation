<?php

declare(strict_types=1);

namespace Albert221\Validation;

use Countable;
use IteratorAggregate;

class Verdicts implements Countable, IteratorAggregate
{
    private $verdicts;

    public function __construct(array $verdicts)
    {
        $this->verdicts = $verdicts;
    }

    public function passing(): Verdicts
    {
        return $this->filter(function (Verdict $verdict) {
            return $verdict->passes();
        });
    }

    public function failing(): Verdicts
    {
        return $this->filter(function (Verdict $verdict) {
            return !$verdict->passes();
        });
    }

    public function forField(string $fieldName): Verdicts
    {
        return $this->filter(function (Verdict $verdict) use ($fieldName) {
            return $verdict->getField()->getName() === $fieldName;
        });
    }

    public function map(callable $function): Verdicts
    {
        return new static(array_map($function, $this->verdicts));
    }

    public function filter(callable $function): Verdicts
    {
        return new static(array_filter($this->verdicts, $function));
    }

    public function reduce(callable $function, $initial = null): Verdicts
    {
        return new static(array_reduce($this->verdicts, $function, $initial));
    }

    public function toArray(): array
    {
        return $this->verdicts;
    }

    public function count(): int
    {
        return count($this->verdicts);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->verdicts);
    }
}

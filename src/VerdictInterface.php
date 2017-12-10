<?php

declare(strict_types=1);

namespace Albert221\Validation;

interface VerdictInterface
{
    /**
     * @return bool
     */
    public function passes(): bool;

    /**
     * @return Field
     */
    public function getField(): Field;
}

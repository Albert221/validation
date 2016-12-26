<?php

namespace Albert221\Validation\Rule;

use DateTime;

class DateAfter implements RuleInterface
{
    use RuleTrait;

    protected $date;

    public function __construct(DateTime $date)
    {
        $this->message = 'This field must have date following the specified date.';

        $this->date = $date;
    }

    public function test($value)
    {
        $value = $value instanceof DateTime ? $value : DateTime::createFromFormat(DateTime::W3C, $value);

        return $value > $this->date;
    }
}
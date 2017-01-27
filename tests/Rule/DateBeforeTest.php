<?php

namespace Albert221\Validation\Rule;

use DateTime;
use PHPUnit_Framework_TestCase;

class DateBeforeTest extends PHPUnit_Framework_TestCase
{
    public function testWithBeforeDate()
    {
        $rule = new DateBefore(new DateTime());

        $this->assertTrue($rule->test(new DateTime('-1 hour')));
    }

    public function testWithEqualDate()
    {
        $date = new DateTime();
        $rule = new DateBefore($date);

        $this->assertFalse($rule->test($date));
    }

    public function testWithAfterDate()
    {
        $rule = new DateBefore(new DateTime());

        $this->assertFalse($rule->test(new DateTime('+1 hour')));
    }
}

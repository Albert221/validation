<?php

namespace Albert221\Validation\Rule;

use PHPUnit_Framework_TestCase;

class RuleTraitTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetMessage()
    {
        $mock = $this->getMockForTrait(RuleTrait::class);

        $this->assertNull($mock->getMessage());

        $mock->setMessage('test');

        $this->assertEquals('test', $mock->getMessage());
    }
}

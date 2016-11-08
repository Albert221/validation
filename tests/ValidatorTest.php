<?php

namespace Albert221\Validation;

use Albert221\Validation\Rule\RuleInterface;
use PHPUnit_Framework_TestCase;

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testOverwritingField()
    {
        $validator = new Validator();
        $validator->addField('test', 1);

        // Overwrite
        $validator->addField('test', 1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNonStringFieldName()
    {
        $validator = new Validator();
        $validator->addField(1, 1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddRuleToNonExistingField()
    {
        $rule = $this->createMock(RuleInterface::class);

        $validator = new Validator();
        $validator->addRule('test', $rule);
    }

    public function testErrorsCount()
    {
        // For failing rule
        $failingRule = $this->createMock(RuleInterface::class);
        $failingRule->method('test')->willReturn(false);

        $failingValidator = new Validator();
        $failingValidator->addField('test', 1);
        $failingValidator->addRule('test', $failingRule);

        $this->assertEquals(1, $failingValidator->getErrorsCount());

        // For passing rule
        $passingRule = $this->createMock(RuleInterface::class);
        $passingRule->method('test')->willReturn(true);

        $passingValidator = new Validator();
        $passingValidator->addField('test', 1);
        $passingValidator->addRule('test', $passingRule);

        $this->assertEquals(0, $passingValidator->getErrorsCount());
    }

    public function testErrorsArray()
    {
        $rule = $this->createMock(RuleInterface::class);
        $rule->method('test')->willReturn(false);
        $rule->method('getMessage')->willReturn('testMessage');

        $validator = new Validator();
        $validator->addField('test', 1);
        $validator->addRule('test', $rule);

        $expected = [
            'test' => [
                'testMessage'
            ]
        ];

        $this->assertEquals($expected, $validator->getErrors());
    }
}

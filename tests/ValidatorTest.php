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
        $validator = new Validator();
        $validator->addRule('test', $this->getPassingRuleMock());
    }

    public function testValidate()
    {
        $validator = new Validator();

        $this->assertInstanceOf(Validator::class, $validator->validate());
    }

    public function testValidateOnAlreadyValidated()
    {
        $validator = new Validator();
        $validator->validate();

        $validator->addField('test', 1);
        $validator->addRule('test', $this->getFailingRuleMock());

        $this->assertEquals(0, $validator->getErrorsCount());

        $this->assertInstanceOf(Validator::class, $validator->validate());
    }

    public function testErrorsCount()
    {
        // For failing rule
        $failingValidator = new Validator();
        $failingValidator->addField('test', 1);
        $failingValidator->addRule('test', $this->getFailingRuleMock());

        $this->assertEquals(1, $failingValidator->validate()->getErrorsCount());

        // For passing rule
        $passingValidator = new Validator();
        $passingValidator->addField('test', 1);
        $passingValidator->addRule('test', $this->getPassingRuleMock());

        $this->assertEquals(0, $passingValidator->validate()->getErrorsCount());
    }

    public function testErrorsArray()
    {
        $rule = $this->getFailingRuleMock();
        $rule->method('getMessage')->willReturn('testMessage');

        $validator = new Validator();
        $validator->addField('test', 1);
        $validator->addRule('test', $rule);

        $expected = [
            'test' => [
                'testMessage'
            ]
        ];

        $this->assertEquals($expected, $validator->validate()->getErrors());
    }

    public function testGetFields()
    {
        $validator = new Validator();

        $validator->addField('test', 'test123');

        $expected = [
            'test' => 'test123'
        ];
        $this->assertEquals($expected, $validator->getFields());
    }

    public function testGetFieldsWithSecret()
    {
        $validator = new Validator();

        $validator->addField('test', 'test123');
        $validator->addField('foo', 'bar', true);

        $expected = [
            'test' => 'test123'
        ];
        $this->assertEquals($expected, $validator->getFields());
    }

    public function testClone()
    {
        $validator = new Validator();
        $validator->addField('test', 1);
        $validator->addRule('test', $this->getFailingRuleMock());

        $validator->validate();

        $newValidator = clone $validator;

        $this->assertEquals(0, $newValidator->getErrorsCount());
    }

    private function getFailingRuleMock()
    {
        $rule = $this->createMock(RuleInterface::class);
        $rule->method('test')->willReturn(false);

        return $rule;
    }

    private function getPassingRuleMock()
    {
        $rule = $this->createMock(RuleInterface::class);
        $rule->method('test')->willReturn(true);

        return $rule;
    }
}

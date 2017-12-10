<?php

declare(strict_types=1);

namespace Albert221\Validation;

use Albert221\Validation\Rule\Rule;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testBuild()
    {
        $validator = Validator::build();

        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testMerge()
    {
        $firstValidator = new Validator();
        $firstValidator->addField('foobar');

        $secondValidator = new Validator();
        $secondValidator->addField('baz');

        $this->assertCount(1, $secondValidator->getFields());

        $secondValidator->merge($firstValidator);

        $this->assertCount(2, $secondValidator->getFields());
        $this->assertArraySubset(
            $firstValidator->getFields(),
            $secondValidator->getFields()
        );
    }

    public function testAddRawField()
    {
        $validator = new Validator();

        $field = new Field('foobar', $validator);
        $validator->addRawField($field);

        $this->assertSame($field, $validator->getFields()['foobar']);
    }

    public function testAddField()
    {
        $validator = new Validator();

        $validator->addField('foobar');

        $this->assertEquals(
            'foobar',
            $validator->getFields()['foobar']->getName()
        );
    }

    public function testValidate()
    {
        $validator = new Validator();

        $verdicts = $validator
            ->addField('field')
            ->addRule($this->getFailingRule($validator, $validator->getFields()['field']))
            ->validate([]);

        $this->assertInstanceOf(VerdictList::class, $verdicts);
        $this->assertTrue($verdicts->fail());
    }

    /**
     * @param Validator $validator
     * @param Field $field
     *
     * @return Rule
     */
    private function getFailingRule(Validator $validator, Field $field): Rule
    {
        return new class($validator, $field) extends Rule {
            protected $message = 'foobartest';

            public function verdict($value): VerdictInterface
            {
                return new Verdict(false, $this, $this->getField());
            }
        };
    }
}

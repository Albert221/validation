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

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddAlreadyExistingField()
    {
        $validator = new Validator();
        $validator->addRawField(new Field('test', $validator));
        $validator->addRawField(new Field('test', $validator));
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

        $rule = new class($validator, $this->createMock(Field::class)) extends Rule {
            public $verdict = false;

            public function verdict($value): VerdictInterface
            {
                $this->verdict = true;
                return new class implements VerdictInterface {
                    public function getField(): Field
                    {
                    }

                    public function passes(): bool
                    {
                    }
                };
            }
        };

        $verdicts = $validator
            ->addField('field')
            ->addRule($rule)
            ->validate([]);

        // Assert that verdict method was called on rules.
        $this->assertTrue($rule->verdict);
        $this->assertInstanceOf(VerdictList::class, $verdicts);
    }
}

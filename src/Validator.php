<?php

declare(strict_types=1);

namespace Albert221\Validation;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Validator
{
    /**
     * @var RuleValidatorFactory
     */
    private $ruleValidatorFactory;

    /**
     * @var Field[]
     */
    private $fields = [];

    /**
     * @return Validator
     */
    public static function build()
    {
        return new self();
    }

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->ruleValidatorFactory = new RuleValidatorFactory();
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Merges given Validator fields with already existing ones.
     * NOTE: It does not merge single rules in fields but the fields as whole.
     *
     * @param Validator $validatorBuilder
     *
     * @return Validator
     */
    public function merge(Validator $validatorBuilder): self
    {
        foreach ($validatorBuilder->getFields() as $field) {
            $this->addRawField($field);
        }

        return $this;
    }

    /**
     * @param Field $field
     *
     * @return Field
     */
    public function addRawField(Field $field)
    {
        if (array_key_exists($field->getName(), $this->fields)) {
            throw new InvalidArgumentException(sprintf(
                'Field with name "%s" already exists.',
                $field->getName()
            ));
        }

        return $this->fields[$field->getName()] = $field;
    }

    /**
     * @param string $name
     *
     * @return Field
     */
    public function addField(string $name): Field
    {
        return $this->addRawField(new Field($name, $this));
    }

    /**
     * @param $data
     *
     * @return VerdictList
     */
    public function validate($data): VerdictList
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $verdicts = [];
        foreach ($this->fields as $field) {
            try {
                $value = $propertyAccessor->getValue(
                    $data,
                    is_array($data) ? "[" . $field->getName() . "]" : $field->getName()
                );
            } catch (RuntimeException $e) {
                $value = null;
            }

            foreach ($field->getRules() as $rule) {
                $ruleValidator = $this->ruleValidatorFactory->getInstance($rule);

                $verdicts[] = $ruleValidator->verdict($value, $rule);
            }
        }

        return new VerdictList($verdicts);
    }
}

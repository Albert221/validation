<?php

declare(strict_types=1);

namespace Albert221\Validation;

use InvalidArgumentException;

class Validator
{
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
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
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
     * @return ValidationState
     */
    public function validate($data): ValidationState
    {
        $verdicts = [];
        foreach ($this->fields as $field) {
            $value = $data[$field->getName()] ?? null;

            foreach ($field->getRules() as $rule) {
                $verdicts[] = $rule->verdict($value);
            }
        }

        return new ValidationState($verdicts);
    }
}

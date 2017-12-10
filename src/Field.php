<?php

declare(strict_types=1);

namespace Albert221\Validation;

use Albert221\Validation\Rule\Rule;
use InvalidArgumentException;

class Field
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var array Rule\Rule[]
     */
    private $rules = [];

    /**
     * Field constructor.
     *
     * @param string $name
     * @param Validator $validator
     */
    public function __construct(string $name, Validator $validator)
    {
        $this->name = $name;
        $this->validator = $validator;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|Rule $rule
     * @param array $options
     *
     * @return Rule
     */
    public function addRule($rule, array $options = []): Rule
    {
        if ($rule instanceof Rule) {
            return $this->rules[] = $rule;
        }

        if (!is_string($rule) || !class_exists($rule) || !is_subclass_of($rule, Rule::class)) {
            throw new InvalidArgumentException(sprintf(
                'First argument must be an instance of %s or fully qualified name of this class, %s given.',
                Rule::class,
                is_scalar($rule) ? gettype($rule) : get_class($rule)
            ));
        }

        return $this->rules[] = new $rule($this->validator, $this, $options);
    }

    /**
     * @return Rule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    //
    // Methods taken from ValidatorBuilder for easy methods chaining.
    //

    /**
     * @param string $name
     *
     * @return Field
     */
    public function addField(string $name): Field
    {
        return $this->validator->addField($name);
    }

    /**
     * @param $data
     *
     * @return VerdictList
     */
    public function validate($data): VerdictList
    {
        return $this->validator->validate($data);
    }
}

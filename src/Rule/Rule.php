<?php

declare(strict_types=1);

namespace Albert221\Validation\Rule;

use Albert221\Validation\Field;
use Albert221\Validation\ValidationState;
use Albert221\Validation\Validator;
use Albert221\Validation\Verdict;
use Albert221\Validation\VerdictInterface;
use Albert221\Validation\VerdictList;

abstract class Rule
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var Field
     */
    private $field;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $message;

    /**
     * Rule constructor.
     *
     * @param Validator $validator
     * @param Field $field
     * @param array $options
     */
    public function __construct(Validator $validator, Field $field, array $options = [])
    {
        $this->field = $field;
        $this->options = $options;
        $this->validator = $validator;
    }

    /**
     * @return Field
     */
    public function getField(): Field
    {
        return $this->field;
    }

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @param $value
     *
     * @return Rule
     */
    public function setOption(string $name, $value)
    {
        $this->options[$name] = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Rule
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return get_class($this) . 'Validator';
    }

    //
    // Methods taken from Field and ValidatorBuilder for easy methods chaining.
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
     * @param $rule
     * @param array $options
     *
     * @return Rule
     */
    public function addRule($rule, array $options = []): Rule
    {
        return $this->field->addRule($rule, $options);
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

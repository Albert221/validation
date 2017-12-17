<?php

declare(strict_types=1);

namespace Albert221\Validation;

trait RuleChainTrait
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
     * @return Field
     */
    public function getField(): Field
    {
        return $this->field;
    }

    /**
     * @param Validator $validator
     * @param Field $field
     *
     * @return Rule
     *
     * @internal
     */
    public function setValidatorAndField(Validator $validator, Field $field): Rule
    {
        $this->validator = $validator;
        $this->field = $field;

        /** @var Rule $rule */
        $rule = $this;
        return $rule;
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

<?php

namespace Albert221\Validation;

use Albert221\Validation\Rule\RuleInterface;

class Validator
{
    protected $rules = [];
    protected $fields = [];
    protected $errors = [];

    protected $validated = false;

    /**
     * Adds field with its value to be validated later.
     *
     * @param string $name
     * @param mixed $value
     */
    public function addField($name, $value)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException(
                sprintf('Field name should be of string type, %s given.', gettype($name))
            );
        }

        if ($this->issetField($name)) {
            throw new \InvalidArgumentException(sprintf('Field \'%s\' has been already added.', $name));
        }

        $this->fields[$name] = $value;
    }

    /**
     * Returns if field is already added.
     *
     * @param string $name
     * @return bool
     */
    public function issetField($name)
    {
        return isset($this->fields[$name]);
    }

    /**
     * Adds validation rule to field with passed name.
     *
     * @param string $fieldName
     * @param RuleInterface $rule
     * @return RuleInterface
     */
    public function addRule($fieldName, RuleInterface $rule)
    {
        if (! $this->issetField($fieldName)) {
            throw new \InvalidArgumentException(
                sprintf('Field \'%s\' does not exist and hence you cannot add rule to it', $fieldName)
            );
        }

        $this->rules[$fieldName][] = $rule;

        return $rule;
    }

    /**
     * Returns count of validation errors.
     *
     * @return int
     */
    public function getErrorsCount()
    {
        // Count recursively items of $errors array and subtract count of items in $errors to get subarray items count.
        $keysCount = count($this->getErrors());
        $count = count($this->getErrors(), COUNT_RECURSIVE);

        return $count - $keysCount;
    }

    /**
     * Returns associative array of field name => error messages pairs.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Validates fields using validation rules
     *
     * @return $this
     */
    public function validate()
    {
        if ($this->validated) {
            return $this;
        }

        foreach ($this->fields as $field => $value) {
            /** @var RuleInterface $rule */
            foreach ($this->rules[$field] as $rule) {
                if ($rule->test($value)) {
                    continue;
                }

                $this->errors[$field][] = $rule->getMessage();
            }
        }

        $this->validated = true;

        return $this;
    }

    /**
     * Clone validator with fields and rules but without validation errors.
     */
    public function __clone()
    {
        $this->validated = false;
        $this->errors = [];
    }
}

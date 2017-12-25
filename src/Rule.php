<?php

declare(strict_types=1);

namespace Albert221\Validation;

abstract class Rule
{
    use RuleChainTrait;

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
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function getOption(string $name, $default = null)
    {
        return $this->options[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param $value
     *
     * @return Rule
     */
    public function setOption(string $name, $value): self
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
    public function setMessage(string $message): self
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
}

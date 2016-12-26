<?php

namespace Albert221\Validation\Rule;

use InvalidArgumentException;
use Psr\Http\Message\UploadedFileInterface;

class MimeType implements RuleInterface
{
    use RuleTrait;

    protected $mimeType;

    public function __construct($mimeType)
    {
        $this->message = 'This field must be of specified MIME type.';

        $this->mimeType = $mimeType;
    }

    public function test($value)
    {
        if (! $value instanceof UploadedFileInterface) {
            throw new InvalidArgumentException(sprintf(
                'MimeType rule excepts field of type %s, %s given.',
                UploadedFileInterface::class,
                gettype($value)
            ));
        }

        return $this->mimeType == $value->getClientMediaType();
    }
}

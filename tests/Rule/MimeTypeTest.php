<?php

namespace Albert221\Validation\Rule;

use Psr\Http\Message\UploadedFileInterface;

class MimeTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testWithValidMimeType()
    {
        $uploadedFile = $this->createMock(UploadedFileInterface::class);
        $uploadedFile->method('getClientMediaType')->willReturn('text/html');

        $rule = new MimeType('text/html');

        $this->assertTrue($rule->test($uploadedFile));
    }

    public function testWithInvalidMimeType()
    {
        $uploadedFile = $this->createMock(UploadedFileInterface::class);
        $uploadedFile->method('getClientMediaType')->willReturn('text/plain');

        $rule = new MimeType('text/html');

        $this->assertFalse($rule->test($uploadedFile));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWithNotUploadedFileInterfaceArgument()
    {
        $rule = new MimeType('text/html');

        $rule->test('test');
    }
}

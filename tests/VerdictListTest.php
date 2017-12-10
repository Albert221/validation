<?php

declare(strict_types=1);

namespace Albert221\Validation;

use PHPUnit\Framework\TestCase;

class VerdictListTest extends TestCase
{
    public function testPasses()
    {
        $list = new VerdictList([$this->getPassingVerdict()]);
        $this->assertTrue($list->pass());

        $list = new VerdictList([$this->getFailingVerdict()]);
        $this->assertFalse($list->pass());

        $list = new VerdictList([
            $this->getPassingVerdict(),
            $this->getFailingVerdict()
        ]);
        $this->assertFalse($list->pass());
    }

    public function testFails()
    {
        $list = new VerdictList([$this->getPassingVerdict()]);
        $this->assertFalse($list->fail());

        $list = new VerdictList([$this->getFailingVerdict()]);
        $this->assertTrue($list->fail());

        $list = new VerdictList([
            $this->getPassingVerdict(),
            $this->getFailingVerdict()
        ]);
        $this->assertTrue($list->fail());
    }

    /**
     * @return VerdictInterface
     */
    private function getPassingVerdict(): VerdictInterface
    {
        return new class implements VerdictInterface {
            public function passes(): bool
            {
                return true;
            }

            public function getField(): Field
            {
                return null;
            }
        };
    }

    /**
     * @return VerdictInterface
     */
    private function getFailingVerdict(): VerdictInterface
    {
        return new class implements VerdictInterface {
            public function passes(): bool
            {
                return false;
            }

            public function getField(): Field
            {
                return null;
            }
        };
    }
}

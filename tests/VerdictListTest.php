<?php

declare(strict_types=1);

namespace Albert221\Validation;

use PHPUnit\Framework\TestCase;

class VerdictListTest extends TestCase
{
    public function testPasses()
    {
        $list = new VerdictList([$this->getPassingVerdict()]);
        $this->assertTrue($list->passes());

        $list = new VerdictList([$this->getFailingVerdict()]);
        $this->assertFalse($list->passes());

        $list = new VerdictList([
            $this->getPassingVerdict(),
            $this->getFailingVerdict()
        ]);
        $this->assertFalse($list->passes());
    }

    public function testFails()
    {
        $list = new VerdictList([$this->getPassingVerdict()]);
        $this->assertFalse($list->fails());

        $list = new VerdictList([$this->getFailingVerdict()]);
        $this->assertTrue($list->fails());

        $list = new VerdictList([
            $this->getPassingVerdict(),
            $this->getFailingVerdict()
        ]);
        $this->assertTrue($list->fails());
    }

    public function testToArray()
    {
        $verdictList = new VerdictList([
            $this->getPassingVerdict()
        ]);

        $this->assertInternalType('array', $verdictList->toArray());
    }

    public function testCount()
    {
        $verdictList = new VerdictList([
            $this->getPassingVerdict(),
            $this->getPassingVerdict(),
            $this->getFailingVerdict()
        ]);

        $this->assertEquals(3, $verdictList->count());
    }

    public function testGetIterator()
    {
        $firstVerdict = $this->getPassingVerdict();

        $verdictList = new VerdictList([
            $firstVerdict,
            $this->getPassingVerdict()
        ]);

        $this->assertEquals($firstVerdict, $verdictList->getIterator()->getArrayCopy()[0]);
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

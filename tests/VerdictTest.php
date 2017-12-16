<?php

declare(strict_types=1);

namespace Albert221\Validation;

use Albert221\Validation\Rule\Rule;
use PHPUnit\Framework\TestCase;

class VerdictTest extends TestCase
{
    public function testCreate()
    {
        $ruleMock = $this->getRuleMock();

        $verdict = Verdict::create(true, $ruleMock);

        $this->assertEquals(
            new Verdict(true, $ruleMock, $ruleMock->getField()),
            $verdict
        );
    }

    public function testPasses()
    {
        $ruleMock = $this->getRuleMock();

        $verdict = new Verdict(true, $ruleMock, $ruleMock->getField());
        $this->assertTrue($verdict->passes());

        $verdict = new Verdict(false, $ruleMock, $ruleMock->getField());
        $this->assertFalse($verdict->passes());
    }

    /**
     * @return Rule Mock of Rule
     */
    private function getRuleMock(): Rule
    {
        return $this
            ->getMockBuilder(Rule::class)
            ->disableOriginalConstructor()
            ->setMethods(['getField', 'verdict'])
            ->getMock();
    }
}

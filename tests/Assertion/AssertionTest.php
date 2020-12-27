<?php

namespace Phare\Tests\Assertion;

use Phare\Assertion\Assertion;
use Phare\File\File;
use Phare\Rule\FileExtension;
use Phare\Tests\TestCase;

class AssertionTest extends TestCase
{
    public function makeAssertion(): Assertion
    {
        return new Assertion(
            'default',
            new File(__DIR__ . '/../stubs/StubTest.php'),
            new FileExtension(['php'])
        );
    }

    public function test_it_get_status(): void
    {
        self::assertEquals(Assertion::STATUS_NOT_PERFORMED, $this->makeAssertion()->getStatus());
    }

    public function test_it_is_not_successful(): void
    {
        self::assertFalse($this->makeAssertion()->successful());
    }

    public function test_it_did_not_failed(): void
    {
        self::assertFalse($this->makeAssertion()->failed());
    }

    public function test_it_get_file(): void
    {
        self::assertEquals(new File(__DIR__ . '/../stubs/StubTest.php'), $this->makeAssertion()->getFile());
    }

    public function test_it_get_scope(): void
    {
        self::assertEquals('default', $this->makeAssertion()->getScope());
    }

    public function test_it_get_rule(): void
    {
        self::assertEquals(new FileExtension(['php']), $this->makeAssertion()->getRule());
    }

    public function test_it_perform_assert(): void
    {
        $ruleMock = $this->createMock(FileExtension::class);

        $ruleMock->expects(self::once())
            ->method('assert')
            ->willReturn(true);

        $assertion = new Assertion('default', new File(__DIR__ . '/../stubs/StubTest.php'), $ruleMock);

        $assertion->perform(false);

        self::assertEquals(Assertion::STATUS_SUCCESS, $assertion->getStatus());
    }

    public function test_it_perform_assert_fail(): void
    {
        $ruleMock = $this->createMock(FileExtension::class);

        $ruleMock->expects(self::once())
            ->method('assert')
            ->willReturn(false);

        $assertion = new Assertion('default', new File(__DIR__ . '/../stubs/StubTest.php'), $ruleMock);

        $assertion->perform(false);

        self::assertEquals(Assertion::STATUS_ERROR, $assertion->getStatus());
    }

    public function test_it_perform_assert_fail_and_not_fixable(): void
    {
        $ruleMock = $this->createMock(FileExtension::class);

        $ruleMock->expects(self::once())
            ->method('assert')
            ->willReturn(false);

        $ruleMock->expects(self::once())
            ->method('fixable')
            ->willReturn(false);

        $assertion = new Assertion('default', new File(__DIR__ . '/../stubs/StubTest.php'), $ruleMock);

        $assertion->perform(true);

        self::assertEquals(Assertion::STATUS_ERROR, $assertion->getStatus());
    }

    public function test_it_perform_assert_fail_and_fixable(): void
    {
        $ruleMock = $this->createMock(FileExtension::class);

        $ruleMock->expects(self::once())
        ->method('assert')
        ->willReturn(false);

        $ruleMock->expects(self::once())
        ->method('fixable')
        ->willReturn(true);

        $assertion = new Assertion('default', new File(__DIR__ . '/../stubs/StubTest.php'), $ruleMock);

        $assertion->perform(true);

        self::assertEquals(Assertion::STATUS_FIXED, $assertion->getStatus());
    }
}

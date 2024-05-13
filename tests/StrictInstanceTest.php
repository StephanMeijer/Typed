<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\StrictInstance;

#[CoversClass(StrictInstance::class)]
#[CoversClass(InvalidTypeException::class)]
class StrictInstanceTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testEnforce(): void
    {
        $instance = new DateTime();

        $this->assertSame($instance, StrictInstance::enforce($instance, DateTime::class));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceThrowsOnFloat(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', DateTime::class));

        StrictInstance::enforce(12345, DateTime::class);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceThrowsOnOtherClass(): void
    {
        $this->expectExceptionObject(new InvalidTypeException(DateTimeZone::class, DateTime::class));

        StrictInstance::enforce(new DateTimeZone("Europe/Amsterdam"), DateTime::class);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullable(): void
    {
        $instance = new DateTime();

        $this->assertNull(StrictInstance::enforceNullable(null, DateTime::class));
        $this->assertSame($instance, StrictInstance::enforceNullable($instance, DateTime::class));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException(DateTime::class, 'null|' . DateTimeZone::class));

        StrictInstance::enforceNullable(new DateTime(), DateTimeZone::class);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullableThrowsOnOtherClass(): void
    {
        $this->expectExceptionObject(new InvalidTypeException(DateTimeZone::class, 'null|' . DateTime::class));

        StrictInstance::enforceNullable(new DateTimeZone("Europe/Amsterdam"), DateTime::class);
    }
}

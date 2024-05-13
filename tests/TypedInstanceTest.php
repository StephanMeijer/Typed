<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\TypedInstance;

#[CoversClass(TypedInstance::class)]
#[CoversClass(InvalidTypeException::class)]
class TypedInstanceTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testCast(): void
    {
        $instance = new DateTime();

        $this->assertSame($instance, TypedInstance::cast($instance, DateTime::class));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastThrowsOnFloat(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', DateTime::class));

        TypedInstance::cast(12345, DateTime::class);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastThrowsOnOtherClass(): void
    {
        $this->expectExceptionObject(new InvalidTypeException(DateTimeZone::class, DateTime::class));

        TypedInstance::cast(new DateTimeZone("Europe/Amsterdam"), DateTime::class);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullable(): void
    {
        $instance = new DateTime();

        $this->assertNull(TypedInstance::castNullable(null, DateTime::class));
        $this->assertSame($instance, TypedInstance::castNullable($instance, DateTime::class));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException(DateTime::class, 'null|' . DateTimeZone::class));

        TypedInstance::castNullable(new DateTime(), DateTimeZone::class);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullableThrowsOnOtherClass(): void
    {
        $this->expectExceptionObject(new InvalidTypeException(DateTimeZone::class, 'null|' . DateTime::class));

        TypedInstance::castNullable(new DateTimeZone("Europe/Amsterdam"), DateTime::class);
    }
}

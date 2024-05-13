<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\TypedString;

#[CoversClass(TypedString::class)]
#[CoversClass(InvalidTypeException::class)]
class TypedStringTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testCast(): void
    {
        $this->assertSame("Hello there", TypedString::cast("Hello there"));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'string'));

        TypedString::cast(12345);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullable(): void
    {
        $this->assertNull(TypedString::castNullable(null));
        $this->assertSame("Hello there", TypedString::cast("Hello there"));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'null|string'));

        TypedString::castNullable(1234);
    }
}

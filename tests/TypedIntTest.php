<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\TypedInt;

#[CoversClass(TypedInt::class)]
#[CoversClass(InvalidTypeException::class)]
class TypedIntTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testCast(): void
    {
        $this->assertSame(3, TypedInt::cast(3));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('double', 'int'));

        TypedInt::cast(12345.3);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullable(): void
    {
        $this->assertNull(TypedInt::castNullable(null));
        $this->assertSame(3, TypedInt::cast(3));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('string', 'null|int'));

        TypedInt::castNullable("x");
    }
}

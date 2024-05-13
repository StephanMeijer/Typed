<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\TypedFloat;

#[CoversClass(TypedFloat::class)]
#[CoversClass(InvalidTypeException::class)]
class TypedFloatTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testCast(): void
    {
        $value = 3.1415;
        $this->assertSame($value, TypedFloat::cast($value));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'float'));

        TypedFloat::cast(12345);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullable(): void
    {
        $this->assertNull(TypedFloat::castNullable(null));
        $this->assertSame(3.14153, TypedFloat::cast(3.14153));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'null|float'));

        TypedFloat::castNullable(1234);
    }
}

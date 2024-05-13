<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\TypedArray;

#[CoversClass(TypedArray::class)]
#[CoversClass(InvalidTypeException::class)]
class TypedArrayTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testCast(): void
    {
        $value = [1, "2", 3.0, null, true];
        $this->assertSame($value, TypedArray::cast($value));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'array'));

        TypedArray::cast(12345);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullable(): void
    {
        $this->assertNull(TypedArray::castNullable(null));
        $this->assertSame([1], TypedArray::cast([1]));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testCastNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'null|array'));

        TypedArray::castNullable(1234);
    }
}

<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\StrictArray;

#[CoversClass(StrictArray::class)]
#[CoversClass(InvalidTypeException::class)]
class StrictArrayTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testEnforce(): void
    {
        $value = [1, "2", 3.0, null, true];
        $this->assertSame($value, StrictArray::enforce($value));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'array'));

        StrictArray::enforce(12345);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullable(): void
    {
        $this->assertNull(StrictArray::enforceNullable(null));
        $this->assertSame([1], StrictArray::enforce([1]));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'null|array'));

        StrictArray::enforceNullable(1234);
    }
}

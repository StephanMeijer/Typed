<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\StrictFloat;

#[CoversClass(StrictFloat::class)]
#[CoversClass(InvalidTypeException::class)]
class StrictFloatTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testEnforce(): void
    {
        $value = 3.1415;
        $this->assertSame($value, StrictFloat::enforce($value));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'float'));

        StrictFloat::enforce(12345);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullable(): void
    {
        $this->assertNull(StrictFloat::enforceNullable(null));
        $this->assertSame(3.14153, StrictFloat::enforce(3.14153));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'null|float'));

        StrictFloat::enforceNullable(1234);
    }
}

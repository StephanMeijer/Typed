<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class StrictFloat
{
    /**
     * @psalm-assert float $value
     *
     * @throws InvalidTypeException
     */
    public static function enforce(mixed $value): float
    {
        if (is_float($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'float');
    }

    /**
     * @psalm-assert null|float $value
     *
     * @throws InvalidTypeException
     */
    public static function enforceNullable(mixed $value): ?float
    {
        if ($value === null || is_float($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|float');
    }
}

<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class TypedFloat
{
    /**
     * @throws InvalidTypeException
     */
    public static function cast(mixed $value): float
    {
        if (is_float($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'float');
    }

    /**
     * @throws InvalidTypeException
     */
    public static function castNullable(mixed $value): ?float
    {
        if ($value === null || is_float($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|float');
    }
}

<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class TypedInt
{
    /**
     * @throws InvalidTypeException
     */
    public static function cast(mixed $value): int
    {
        if (is_int($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'int');
    }

    /**
     * @throws InvalidTypeException
     */
    public static function castNullable(mixed $value): ?int
    {
        if ($value === null || is_int($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|int');
    }
}

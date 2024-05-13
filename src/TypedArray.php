<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class TypedArray
{
    /**
     * @throws InvalidTypeException
     *
     * @param mixed $value
     * @return array<mixed, mixed>
     */
    public static function cast(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'array');
    }

    /**
     * @throws InvalidTypeException
     *
     * @param mixed $value
     * @return null|array<mixed, mixed>
     */
    public static function castNullable(mixed $value): ?array
    {
        if ($value === null || is_array($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|array');
    }
}

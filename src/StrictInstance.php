<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class StrictInstance
{
    /**
     * @template T of object
     *
     * @psalm-assert T $value
     *
     * @param mixed $value
     * @param class-string<T> $className
     * @return T
     *
     * @throws InvalidTypeException
     */
    public static function enforce(mixed $value, string $className): mixed
    {
        if (is_object($value) && get_class($value) === $className) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, $className);
    }

    /**
     * @template T of object
     *
     * @psalm-assert null|T $value
     *
     * @param mixed $value
     * @param class-string<T> $className
     * @return ?T
     *
     * @throws InvalidTypeException
     */
    public static function enforceNullable(mixed $value, string $className): mixed
    {
        if ($value === null) {
            return null;
        }

        if (is_object($value) && get_class($value) === $className) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|' . $className);
    }
}

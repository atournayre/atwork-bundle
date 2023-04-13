<?php

namespace Atournayre\Bundle\AtWorkBundle\Doctrine\DBAL\Types;

use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Atournayre\Types\Coordinates;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class CoordinatesType extends Type implements DoctrineType
{
    public const NAME = 'coordinates';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Coordinates) {
            throw new \InvalidArgumentException('Expected Coordinates, got '.\gettype($value));
        }

        return $value->toJson();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof Coordinates) {
            return $value;
        }

        return Coordinates::fromJson($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getJsonTypeDeclarationSQL($column);
    }
}

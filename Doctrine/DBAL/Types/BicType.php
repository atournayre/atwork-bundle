<?php

namespace Atournayre\Bundle\AtWorkBundle\Doctrine\DBAL\Types;

use Atournayre\Types\Bic;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class BicType extends AbstractFixedLengthStringType
{
    public const NAME = 'bic';
    public const LENGTH = 11;

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getLength(): int
    {
        return self::LENGTH;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if (!$value instanceof Bic) {
            throw new \InvalidArgumentException('Expected Bic, got '.\gettype($value));
        }

        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof Bic) {
            return $value;
        }

        return Bic::fromString($value);
    }
}

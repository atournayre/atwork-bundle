<?php

namespace Atournayre\Bundle\AtWorkBundle\Doctrine\DBAL\Types;

use Atournayre\Types\Iban;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class IbanType extends AbstractFixedLengthStringType
{
    public const NAME = 'iban';
    public const LENGTH = 34;

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

        if (!$value instanceof Iban) {
            throw new \InvalidArgumentException('Expected Iban, got '.\gettype($value));
        }

        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof Iban) {
            return $value;
        }

        return Iban::fromString($value);
    }
}

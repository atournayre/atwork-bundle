<?php

namespace Atournayre\Bundle\AtWorkBundle\Doctrine\DBAL\Types;

use Atournayre\Types\EmailAddress;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EmailAddressType extends AbstractFixedLengthStringType
{
    public const NAME = 'email_address';
    public const LENGTH = 255;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if (!$value instanceof EmailAddress) {
            throw new \InvalidArgumentException('Expected EmailAddress, got '.\gettype($value));
        }

        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof EmailAddress) {
            return $value;
        }

        return EmailAddress::fromString($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    protected function getLength(): int
    {
        return self::LENGTH;
    }
}

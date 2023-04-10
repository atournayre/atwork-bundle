<?php

namespace Atournayre\Bundle\AtWorkBundle\Doctrine\DBAL\Types;

use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Atournayre\Bundle\AtWorkBundle\Type\EmailAddress;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class EmailAddressType extends Type implements DoctrineType
{
    public const NAME = 'email_address';
    public const LENGTH = 255;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL(['length' => self::LENGTH]);
    }

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

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}

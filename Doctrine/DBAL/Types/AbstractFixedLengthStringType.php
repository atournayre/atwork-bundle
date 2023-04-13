<?php

namespace Atournayre\Bundle\AtWorkBundle\Doctrine\DBAL\Types;

use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class AbstractFixedLengthStringType extends Type implements DoctrineType
{
    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $column['length'] = $this->getLength();
        return $platform->getStringTypeDeclarationSQL($column);
    }

    abstract protected function getLength(): int;

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}

<?php

namespace Atournayre\Bundle\AtWorkBundle\Fixture\Provider;

use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
use Symfony\Component\Uid\Uuid;

class TypeProvider implements FixtureProvider
{
    public function uuid(?string $uuid = null): Uuid
    {
        if (is_null($uuid)) {
            return Uuid::v4();
        }

        return Uuid::fromString($uuid);
    }
}

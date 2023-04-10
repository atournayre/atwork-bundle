<?php

namespace Atournayre\Bundle\AtworkBundle\Fixture\Provider;

use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
use Doctrine\ORM\EntityManagerInterface;

class EntityProvider implements FixtureProvider
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param string|int   $identifier
     * @param class-string $entityFqcn
     *
     * @return object|null
     */
    public function entity(string|int $identifier, string $entityFqcn): ?object
    {
        $repository = $this->entityManager->getRepository($entityFqcn);

        if (is_int($identifier)) {
            return $repository->find($identifier);
        }

        return $repository->findOneBy(['uuid' => $identifier]);
    }
}

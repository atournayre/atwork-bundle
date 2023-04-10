<?php

namespace Atournayre\Bundle\AtWorkBundle\Fixture\Provider;

use Atournayre\Bundle\AtWorkBundle\Service\Security\PasswordHasherService;

class HashPasswordProvider
{
    public function __construct(
        private readonly PasswordHasherService $passwordHasherService,
    )
    {
    }

    public function hashPassword(string $plainPassword): string
    {
        return $this->passwordHasherService->generate('', $plainPassword);
    }
}

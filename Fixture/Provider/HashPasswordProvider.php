<?php

namespace Atournayre\Bundle\AtWorkBundle\Fixture\Provider;

use Atournayre\Bundle\AtWorkBundle\Service\Security\PasswordHasherService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class HashPasswordProvider
{
    private string $userClass;

    public function __construct(
        private readonly PasswordHasherService $passwordHasherService,
        #[Autowire('atournayre_atwork.security.providers.entity.class')] string $userClass,
    )
    {
        $this->userClass = $userClass;
    }

    public function hashPassword(string $plainPassword): string
    {
        $user = new ($this->userClass)();
        return $this->passwordHasherService->generate($user, $plainPassword);
    }
}

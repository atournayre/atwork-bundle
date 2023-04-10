<?php

namespace Atournayre\Bundle\AtWorkBundle\Fixture\Provider;

use Atournayre\Bundle\AtWorkBundle\Service\Security\PasswordHasherService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class HashPasswordProvider
{
    public function __construct(
        private readonly PasswordHasherService $passwordHasherService,
        private readonly ParameterBagInterface $parameterBag,
    )
    {
    }

    public function hashPassword(string $plainPassword): string
    {
        $userClass = $this->parameterBag->get('atournayre_atwork.security.providers.entity.class');

        $user = new $userClass();
        return $this->passwordHasherService->generate($user, $plainPassword);
    }
}

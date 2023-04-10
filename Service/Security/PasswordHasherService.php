<?php

namespace Atournayre\Bundle\AtWorkBundle\Service\Security;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class PasswordHasherService
{
    public function __construct(
        private readonly PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {
    }

    public function updatePassword(PasswordAuthenticatedUserInterface $user, string $plainPassword): void
    {
        if (!method_exists($user, 'setPassword')) {
            throw new \InvalidArgumentException(sprintf('%s must implement setPassword().', get_class($user)));
        }

        $hash = $this->generate($user, $plainPassword);
        $user->setPassword($hash);
    }

    public function generate(string|PasswordAuthenticatedUserInterface $user, string $plainPassword): string
    {
        return $this->passwordHasherFactory
            ->getPasswordHasher($user)
            ->hash($plainPassword);
    }
}

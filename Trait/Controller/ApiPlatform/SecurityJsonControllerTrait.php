<?php

namespace Atournayre\Bundle\AtWorkBundle\Trait\Controller\ApiPlatform;

use ApiPlatform\Api\IriConverterInterface;
use ApiPlatform\Api\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

trait SecurityJsonControllerTrait
{
    #[Route('/login', name: 'app_login', methods: [Request::METHOD_POST])]
    public function login(
        IriConverterInterface $iriConverter,
        #[CurrentUser] UserInterface $user = null
    ): Response {
        if (!$user) {
            return $this->json([
                'error' => 'Connexion request is invalid.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new Response(null, Response::HTTP_NO_CONTENT, [
            'Location' => $iriConverter->getIriFromResource($user, UrlGeneratorInterface::ABS_URL),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

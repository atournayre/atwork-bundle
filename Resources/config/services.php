<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Atournayre\Bundle\AtWorkBundle\Command\OverrideMakeEntityCommand;
use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
use Atournayre\Bundle\AtWorkBundle\DependencyInjection\CompilerPass\DoctrineTypePass;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\DateTimeProvider;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\EntityProvider;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\HashPasswordProvider;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\TypeProvider;
use Atournayre\Bundle\AtWorkBundle\Service\Security\PasswordHasherService;

return static function (ContainerConfigurator $container) {
    $tagNelmioAliceFakerProvider = 'nelmio_alice.faker.provider';

    $services = $container->services()
        ->defaults()
        ->instanceof(FixtureProvider::class)->tag($tagNelmioAliceFakerProvider)
        // TODO Replace by recipe with all the types commented
        ->instanceof(DoctrineType::class)->tag(DoctrineTypePass::TAG);

    // Fixtures : Providers
    $fixturesProviders = [
        DateTimeProvider::class,
        TypeProvider::class,
        EntityProvider::class,
        HashPasswordProvider::class,
    ];

    foreach ($fixturesProviders as $fixturesProvider) {
        $services->set($fixturesProvider)->autowire()->public()->tag($tagNelmioAliceFakerProvider);
    }

    // Commands
    $services
        ->set(OverrideMakeEntityCommand::class)->public()->tag('console.command');

    // Services
    $services
        ->set(PasswordHasherService::class)->public();
};

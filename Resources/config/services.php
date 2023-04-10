<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Atournayre\Bundle\AtWorkBundle\Command\OverrideMakeEntityCommand;
use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
use Atournayre\Bundle\AtWorkBundle\DependencyInjection\CompilerPass\DoctrineTypePass;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->instanceof(FixtureProvider::class)->tag('nelmio_alice.faker.provider')
        // TODO Replace by recipe with all the types commented
        ->instanceof(DoctrineType::class)->tag(DoctrineTypePass::TAG);

    $services
        ->set(OverrideMakeEntityCommand::class)->public()->tag('console.command');
};

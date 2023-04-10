<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Atournayre\Bundle\AtWorkBundle\Command\OverrideMakeEntityCommand;
use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
use Atournayre\Bundle\AtWorkBundle\DependencyInjection\CompilerPass\DoctrineTypePass;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\DateTimeProvider;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\EntityProvider;
use Atournayre\Bundle\AtWorkBundle\Fixture\Provider\TypeProvider;

return static function (ContainerConfigurator $container) {
    $tagNelmioAliceFakerProvider = 'nelmio_alice.faker.provider';

    $services = $container->services()
        ->defaults()
        ->instanceof(FixtureProvider::class)->tag($tagNelmioAliceFakerProvider)
        // TODO Replace by recipe with all the types commented
        ->instanceof(DoctrineType::class)->tag(DoctrineTypePass::TAG);

    $services
        ->set(DateTimeProvider::class)->autowire()->public()->tag($tagNelmioAliceFakerProvider)
        ->set(TypeProvider::class)->autowire()->public()->tag($tagNelmioAliceFakerProvider)
        ->set(EntityProvider::class)->autowire()->public()->tag($tagNelmioAliceFakerProvider)
    ;

    $services
        ->set(OverrideMakeEntityCommand::class)->public()->tag('console.command');
};

<?php

namespace Atournayre\Bundle\AtWorkBundle\DependencyInjection;

use Atournayre\Bundle\AtWorkBundle\Contracts\DoctrineType;
use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
use Atournayre\Bundle\AtWorkBundle\DependencyInjection\CompilerPass\DoctrineTypePass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class AtWorkExtension extends Extension
{
    public function getAlias(): string
    {
        return 'atournayre_atwork';
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $loader->load('services.php');

        $container->registerForAutoconfiguration(FixtureProvider::class)
            ->addTag('nelmio_alice.fixture_provider');

        // TODO Replace by recipe with all the types commented
        $container->registerForAutoconfiguration(DoctrineType::class)
            ->addTag(DoctrineTypePass::TAG);
    }
}

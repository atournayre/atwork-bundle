<?php

namespace Atournayre\Bundle\AtWorkBundle\DependencyInjection;

use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;
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
            ->setPublic(true)
            ->addTag('nelmio_alice.fixture_provider');

        $container->setParameter('atournayre_atwork.security.providers.entity.class', $config['security']['providers']['entity']['class']);
    }
}

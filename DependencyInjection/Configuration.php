<?php

namespace Atournayre\Bundle\AtWorkBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('atournayre_atwork');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('security')
                    ->children()
                        ->arrayNode('providers')
                            ->children()
                                ->arrayNode('entity')
                                    ->children()
                                        ->arrayNode('class')
                                            ->prototype('scalar')->defaultValue('App\Entity\User')->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;

        return $treeBuilder;
    }
}

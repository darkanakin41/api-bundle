<?php

namespace Darkanakin41\ApiBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('darkanakin41_api');

        $rootNode->children()
            ->arrayNode('clients')
                ->children()
                    ->arrayNode('google')
                        ->children()
                            ->scalarNode('application_key')->end()
                            ->scalarNode('referer')->end()
                        ->end()
                    ->end()
                    ->arrayNode('twitch')
                        ->children()
                            ->scalarNode('client_id')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

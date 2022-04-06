<?php

/**
 * Meta Bundle
 *
 * PHP 8 | Symfony 5.4 | 6
 *
 * Copyright LongitudeOne - Alexandre Tranchant
 *
 * Copyright 2021 - 2022
 */

namespace LongitudeOne\MetaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('meta');

        $treeBuilder->getRootNode()->children()
                ->arrayNode('defaults')
                    ->defaultValue([])
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('paths')
                    ->defaultValue([])
                    ->useAttributeAsKey('url')
                    ->arrayPrototype()
                        ->scalarPrototype()
                            ->validate()->ifArray()->thenInvalid('Tag content shall be a string')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

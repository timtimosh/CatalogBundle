<?php

namespace Mtt\CatalogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mtt_catalog');

        $rootNode
            ->children()
                ->scalarNode('product_entity')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('category_entity')->defaultNull()->cannotBeEmpty()->end()
                ->scalarNode('characteristic_entity')->defaultNull()->cannotBeEmpty()->end()
                ->scalarNode('characteristic_value_entity')->defaultNull()
            ->end()
            ->end();


        return $treeBuilder;
    }
}

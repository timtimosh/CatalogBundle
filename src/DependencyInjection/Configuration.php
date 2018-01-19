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
                    ->arrayNode('entities')
                        ->children()
                            ->scalarNode('Category')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('CategoryDescription')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('CategoryToProduct')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('Char')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('CharValue')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('CharValueDescription')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('Product')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('ProductDescription')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('ProductCharsCollection')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('ProductImage')->isRequired()->cannotBeEmpty()->end()
                        ->end()
                    ->end()
            ->end();

        return $treeBuilder;
    }
}

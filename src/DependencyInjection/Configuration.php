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

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mtt_catalog');

        $rootNode->children()
                    ->scalarNode('product_entity')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('category_entity')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('characteristic_entity')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('characteristic_value_entity')->isRequired()->cannotBeEmpty()->end()
                    ->arrayNode('products_per_page')->scalarPrototype()->isRequired()->end()->end()
                    ->scalarNode('default_product_limit')->cannotBeEmpty()->end()
                    ->scalarNode('image_path')->defaultNull()->isRequired()->cannotBeEmpty()->end()

                    ->scalarNode('easy_admin_integration')->defaultFalse()
                ->end()
            ->end();


        return $treeBuilder;
    }
}

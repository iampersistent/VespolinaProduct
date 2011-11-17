<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\ProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vespolina_product');
        $rootNode
            ->children()
                ->scalarNode('db_driver')->cannotBeOverwritten()->isRequired()->cannotBeEmpty()->end()
            ->end();
        
        $this->addIdentifierSetSection($rootNode);
        $this->addOptionGroupSection($rootNode);
        $this->addOptionSection($rootNode);
        $this->addOptionSetSection($rootNode);
        $this->addProductManagerSection($rootNode);
        $this->addProductSection($rootNode);

        return $treeBuilder;
    }

    private function addIdentifierSetSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('identifier_set')
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->end()
                                ->scalarNode('name')->end()
                                ->scalarNode('data_class')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addOptionGroupSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('option_group')
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->end()
                                ->scalarNode('name')->end()
                                ->scalarNode('data_class')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addOptionSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('option')
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->end()
                                ->scalarNode('name')->end()
                                ->scalarNode('data_class')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }


    private function addOptionSetSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('option_set')
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->end()
                                ->scalarNode('name')->end()
                                ->scalarNode('data_class')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addProductSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('product')
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->end()
                                ->scalarNode('handler_class')->end()
                                ->scalarNode('handler_service')->end()
                                ->scalarNode('name')->end()
                                ->scalarNode('data_class')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addProductManagerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()

                ->arrayNode('product_manager')
                    ->children()
                    ->scalarNode('primary_identifier')->isRequired()->cannotBeEmpty()->end()

                    ->arrayNode('identifiers')
                        ->useAttributeAsKey('name')
                        ->prototype('scalar')
                        ->end()
                    ->end()
                    ->scalarNode('image_manager')->defaultNull()->end()
                ->end()

            ->end()
        ;
    }
}

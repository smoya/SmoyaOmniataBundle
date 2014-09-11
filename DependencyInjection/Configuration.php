<?php

namespace Smoya\Bundle\OmniataBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('smoya_omniata');

        $rootNode
            ->children()
                ->scalarNode('api_key')->isRequired()->end()
                ->arrayNode('tracker')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('timeout')->defaultValue(null)->end()
                        ->scalarNode('url')->defaultValue('https://api.omniata.com/event')->end()
                    ->end()
                ->end()
                ->arrayNode('deliverer')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('timeout')->defaultValue(null)->end()
                        ->scalarNode('url')->defaultValue('https://api.omniata.com/channel')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

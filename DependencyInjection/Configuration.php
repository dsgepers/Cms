<?php

namespace Opifer\CmsBundle\DependencyInjection;

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
     * @see http://symfony.com/doc/current/components/config/definition.html
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $rootNode = $builder->root('opifer_cms');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('allowed_locales')
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')->end()
                    ->defaultValue(array('nl_NL'))
                ->end()

                ->arrayNode('autocomplete')
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('class')
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('property')
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('pagination')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('limit')->min(0)->defaultValue(2)->end()
                    ->end()
                ->end()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('address')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Adress')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('address_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\AdressValue')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('attribute')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Attribute')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('content')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Content')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('cron')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Cron')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('directory')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Directory')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('group')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Group')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('html_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\HtmlValue')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('layout')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Layout')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('log')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Log')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('media')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Media')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('menu_group_value')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\MenuGroupValue')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('option')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Option')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('post')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Post')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('redirect')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Redirect')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('setting')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Setting')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('site')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Site')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('template')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\Template')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\User')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('value_set')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\ValueSet')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->children()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Opifer\CmsBundle\Entity\User')->end()
                                ->scalarNode('repository')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $builder;
    }
}

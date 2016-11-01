<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony\DependencyInjection;

use Arki\RequestId\RequestId;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $tree = new TreeBuilder();
        $root = $tree->root($this->alias);

        $root
            ->children()
                ->scalarNode('request_header')
                    ->cannotBeEmpty()
                    ->defaultValue(RequestId::HEADER_NAME)
                    ->info('The header in which the bundle will look for and set request IDs')
                ->end()
                ->booleanNode('trust_request_header')
                    ->defaultValue(true)
                    ->info("Whether or not to trust the incoming request's `Request-Id` header as a real ID")
                ->end()
                ->scalarNode('response_header')
                    ->cannotBeEmpty()
                    ->defaultValue('Request-Id')
                    ->info('The header the bundle will set the request ID at in the response')
                ->end()
                ->scalarNode('storage_service')
                    ->info('The service name for request ID storage. Defaults to `SimpleIdStorage`')
                ->end()
                ->scalarNode('generator_service')
                    ->info('The service name for the request ID generator. Defaults to `Uuid4IdGenerator`')
                ->end()
                ->booleanNode('enable_monolog')
                    ->info('Whether or not to turn on the request ID processor for monolog')
                    ->defaultTrue()
                ->end()
                ->booleanNode('enable_twig')
                    ->info('Whether or not to enable the twig `request_id()` function. Only works if TwigBundle is present.')
                    ->defaultTrue()
                ->end();

        return $tree;
    }
}

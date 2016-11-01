<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony;

use Arki\RequestId\Integrations\Symfony\DependencyInjection\Extension;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ArkiRequestIdBundle extends Bundle
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias = 'arki_request_id')
    {
        $this->alias = $alias;
    }

    /**
     * @return \Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getContainerExtension()
    {
        $this->extension = new Extension($this->alias);

        return parent::getContainerExtension();
    }

    /**
     * @param Application $application
     */
    public function registerCommands(Application $application)
    {
        // this bundle does not register any commands
    }
}

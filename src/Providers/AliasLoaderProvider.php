<?php

namespace Concretehouse\Component\Classes\Providers;

use Concretehouse\Component\Classes\AliasLoader;
use Concretehouse\Component\Classes\Functions;

/**
 * Provides HqApp.
 */
class AliasLoaderProvider implements \Pimple\ServiceProviderInterface
{
    /**
     * @param \Pimple\Container $container
     */
    public function register(\Pimple\Container $container)
    {
        $container['class_alias_loader.defaults'] = function($c) {
            return array();
        };

        $container['class_alias_loader.functions'] = function($c) {
            return new Functions;
        };

        $container['class_alias_loader'] = function($c) {
            return new AliasLoader(
                $c['class_alias_loader.functions'],
                $c['class_alias_loader.defaults']
            );
        };
    }
}

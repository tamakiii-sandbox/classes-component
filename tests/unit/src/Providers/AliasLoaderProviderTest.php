<?php

namespace Concretehouse\Component\Classes\Test\Unit\Providers;

use Concretehouse\Component\Classes\Providers\AliasLoaderProvider;
use Phake;

/**
 * Test for alias loader.
 */
class AliasLoaderProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set up.
     */
    public function setUp()
    {
        $this->container = new \Pimple\Container;
        $this->provider = new AliasLoaderProvider;
    }

    /**
     * @test
     */
    public function willSet()
    {
        $this->provider->register($this->container);

        $this->assertSame(array(), $this->container['class_alias_loader.defaults']);

        $this->assertInstanceOf(
            '\Concretehouse\Component\Classes\FunctionsInterface',
            $this->container['class_alias_loader.functions']
        );

        $this->assertInstanceOf(
            '\Concretehouse\Component\Classes\AliasLoader',
            $this->container['class_alias_loader']
        );
    }
}

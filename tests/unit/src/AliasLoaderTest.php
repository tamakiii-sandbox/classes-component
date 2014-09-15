<?php

namespace Concretehouse\Component\Test\Unit\Classes;

use Concretehouse\Component\Classes\AliasLoader;
use Phake;

/**
 * Test for alias loader.
 */
class AliasLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set up.
     */
    public function setUp()
    {
        $this->functions = Phake::mock('Concretehouse\Component\Classes\FunctionsInterface');
        Phake::when($this->functions)->classAlias(Phake::anyParameters())->thenReturn(true);

        $this->loader = new AliasLoader(
            $this->functions,
            array(
                'hoge' => 'HogeClass',
                'fuga' => array('FugaClass', false),
            )
        );
    }

    /**
     * @test
     */
    public function implementsAliasLoaderInterface()
    {
        $this->assertInstanceOf('Concretehouse\Component\Classes\AliasLoaderInterface', $this->loader);
    }

    /**
     * @test
     */
    public function canResolveWithAliasesPassedToConstructor()
    {
        $this->assertTrue($this->loader->resolve('hoge'));
        $this->assertTrue($this->loader->resolve('fuga'));

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('HogeClass', 'hoge', true);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('FugaClass', 'fuga', false);
    }

    /**
     * @test
     */
    public function setResolveWithAliasSetWithSetMethod()
    {
        $this->loader->add('baa', 'BaaClass');
        $this->loader->add('baz', 'BazClass', false);

        $this->assertTrue($this->loader->resolve('hoge'));
        $this->assertTrue($this->loader->resolve('fuga'));
        $this->assertTrue($this->loader->resolve('baa'));
        $this->assertTrue($this->loader->resolve('baz'));

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('HogeClass', 'hoge', true);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('FugaClass', 'fuga', false);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('BaaClass', 'baa', true);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('BazClass', 'baz', false);
    }

    /**
     * @test
     */
    public function canAdd()
    {
        $this->loader->add('baa', 'BaaClass');
        $this->loader->add('baz', 'BazClass', false);

        $this->loader->resolve('hoge');
        $this->loader->resolve('fuga');
        $this->loader->resolve('baa');
        $this->loader->resolve('baz');

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('HogeClass', 'hoge', true);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('FugaClass', 'fuga', false);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('BaaClass', 'baa', true);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('BazClass', 'baz', false);
    }

    /**
     * @test
     */
    public function addOverridesPrevious()
    {
        $this->loader->add('hoge', 'NeoHogeClass');
        $this->loader->add('fuga', 'NeoFugaClass', true);

        $this->loader->resolve('hoge');
        $this->loader->resolve('fuga');

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('NeoHogeClass', 'hoge', true);

        Phake::verify($this->functions, Phake::times(1))
            ->classAlias('NeoFugaClass', 'fuga', true);
    }

    /**
     * @test
     */
    public function canRegister()
    {
        $this->loader->register();

        Phake::verify($this->functions, Phake::times(1))
            ->splAutoloadRegister(
                array($this->loader, 'resolve'),
                true,
                true
            );
    }

    /**
     * @test
     */
    public function canRegisterOnlyOnce()
    {
        $this->loader->register();
        $this->loader->register();
        $this->loader->register();

        Phake::verify($this->functions, Phake::times(1))
            ->splAutoloadRegister(
                array($this->loader, 'resolve'),
                true,
                true
            );
    }
}

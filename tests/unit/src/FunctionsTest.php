<?php

namespace Concretehouse\Component\Test\Unit\Classes;

use Concretehouse\Component\Classes\Functions;
use Phake;

class Hoge {}
class Resolver { function resolve($name) {} }

/**
 * Test for functions class.
 */
class FunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set up.
     */
    public function setUp()
    {
        $this->functions = new Functions;
    }

    /**
     * @test
     */
    public function implementsFunctionsInterface()
    {
        $this->assertInstanceOf('Concretehouse\Component\Classes\FunctionsInterface', $this->functions);
    }

    /**
     * @test
     */
    public function canMakeAlias()
    {
        $result = $this->functions->classAlias(__NAMESPACE__ . '\Hoge', 'hoge1', true);

        $hoge = new Hoge;
        $hoge1 = new \hoge1;

        $this->assertTrue($result);
        $this->assertTrue($hoge instanceof $hoge1);
        $this->assertTrue($hoge instanceof \hoge1);
    }

    /**
     * @test
     */
    public function canRegisterAutoloadCallback()
    {
        $resolver = Phake::mock('Concretehouse\Component\Test\Unit\Classes\Resolver');
        Phake::when($resolver)
            ->resolve('hoge2')
            ->thenReturn('\\' . __NAMESPACE__ . '\Hoge');

        $this->functions->splAutoloadRegister(array($resolver, 'resolve'));

        class_exists('hoge2');

        Phake::verify($resolver, Phake::times(1))
            ->resolve('hoge2');
    }
}

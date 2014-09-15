<?php

namespace Concretehouse\Component\Test\Unit\Classes;

use Phake;

/**
 * Test for alias loader interface.
 */
class AliasLoaderInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function canImplement()
    {
        Phake::mock('Concretehouse\Component\Classes\AliasLoaderInterface');
    }
}

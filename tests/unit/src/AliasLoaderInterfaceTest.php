<?php

namespace Concretehouse\Component\Classes\Test\Unit;

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

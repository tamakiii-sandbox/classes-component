<?php

namespace Concretehouse\Component\Test\Unit\Classes;

use Phake;

/**
 * Test for functions interface.
 */
class FunctionsInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function canImplement()
    {
        Phake::mock('Concretehouse\Component\Classes\FunctionsInterface');
    }
}

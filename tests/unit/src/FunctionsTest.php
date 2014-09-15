<?php

namespace Concretehouse\Component\Test\Unit\Classes;

use Concretehouse\Component\Classes\Functions;
use Phake;

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
}

<?php

namespace Test\Model;

use Exception;
use PHPUnit\Framework\TestCase;


class DirectionTest extends TestCase
{

    /**
     * Test that getOrientation function returns the right value of Orientation
     */
    public function testThatGetOrientationReturnsTheRightValue()
    {
        $orientation = 'N';
        $direction = new Direction($orientation);
        $this->assertEquals($orientation, $direction->getOrientation());
    }

    /**
     * Test that setOrientation function changes the value of orientation
     */
    public function testThatSetOrientationChangesTheOrientationValue()
    {
        $direction = new Direction('N');
        $orientation = 'W';
        $direction->setOrientation($orientation);
        $this->assertEquals($orientation, $direction->getOrientation());
    }

    /**
     * Test that instantiating the direction class with wrong direction throws an exception
     */
    public function testThatPassingTheWrongDirectionThrowsAnException()
    {
        $this->expectedException(Exception::class);
        $direction = new Direction('F');
    }
}
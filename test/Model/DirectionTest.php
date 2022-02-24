<?php
declare(strict_types=1);

namespace Test\Model;

use App\Model\Direction;
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
     * Test that setOrientation function changes the orientation
     */
    public function testThatSetOrientationChangesTheOrientation()
    {
        $newOrientation = 'W';
        $direction = new Direction('N');
        $direction->setOrientation($newOrientation);
        $this->assertEquals($newOrientation, $direction->getOrientation());
    }

    /**
     * Test that instantiating the direction class with wrong direction throws an exception
     */
    public function testThatPassingTheWrongDirectionThrowsAnException()
    {
        $this->expectException(Exception::class);
        $direction = new Direction('F');
    }
}
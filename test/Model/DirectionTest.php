<?php
declare(strict_types=1);

namespace Test\Model;

use App\Data\DirectionTypes;
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
        $direction = new Direction(DirectionTypes::NORTH);
        $this->assertEquals(DirectionTypes::NORTH, $direction->getOrientation());
    }

    /**
     * Test that setOrientation function changes the orientation
     */
    public function testThatSetOrientationChangesTheOrientation()
    {
        $direction = new Direction(DirectionTypes::NORTH);
        $direction->setOrientation(DirectionTypes::WEST);
        $this->assertEquals(DirectionTypes::WEST, $direction->getOrientation());
    }

    /**
     * Test that instantiating the direction class with wrong direction throws an exception
     */
    public function testThatPassingTheWrongDirectionThrowsAnException()
    {
        $this->expectException(Exception::class);
        new Direction('F');
    }
}
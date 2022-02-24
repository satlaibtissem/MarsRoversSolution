<?php
declare(strict_types=1);

namespace Test\Model;

use App\Data\DirectionTypes;
use App\Model\Coordinate;
use App\Model\Direction;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class RoverTest extends TestCase
{
    use ModelMokeryTrait;

   /**
     * @var Coordinate
     */
    private $coordinate;
    /**
     * @var Direction
     */
    private $direction;
    /**
     * @var Rover
     */
    private $rover;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->coordinate = $this->getCoordinateMock(1, 2);
        $this->direction = $this->getDirectionMock(DirectionTypes::NORTH);
        $this->rover = new Rover($this->coordinate, $this->direction);
    }

    /**
     * Test that getCoordinate function returns the right value
     */
    public function testThatGetCoordinateReturnsTheRightValue()
    {
        $this->assertEquals($this->coordinate, $this->rover->getCoordinate());
    }

    /**
     * Test that getDirection function returns the right value
     */
    public function testThatGetDirectionReturnsTheRightValue()
    {
        $this->assertEquals($this->direction, $this->rover->getDirection());
    }

    /**
     * Test that setCoordinate function changes the coordinate of the rover
     */
    public function testThatSetCoordinateChangesTheCoordinateOfRover()
    {
        $this->coordinate = $this->getCoordinateMock(1, 2);
        $this->rover->setCoordinate($this->coordinate);
        $this->assertEquals($this->coordinate, $this->rover->getCoordinate());
    }

    /**
     * Test that setDirection function changes the direction of the rover
     */
    public function testThatSetDirectionChangesTheDirectionOfRover()
    {
        $this->direction = $this->getDirectionMock(DirectionTypes::NORTH);
        $this->rover->setDirection($this->direction);
        $this->assertEquals($this->direction, $this->rover->getDirection());
    }

    /**
     * Test that toString function returns the right value
     */
    public function testThatToStringFunctionReturnsTheRightValue()
    {
        $this->coordinate = $this->getCoordinateMock(1, 2);
        $this->rover->setCoordinate($this->coordinate);
        $this->direction = $this->getDirectionMock(DirectionTypes::NORTH);
        $this->rover->setDirection($this->direction);
        $this->assertEquals('1 2 ' . DirectionTypes::NORTH, $this->rover->toString());
    }
}
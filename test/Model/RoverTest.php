<?php

namespace Test\Model;

use PHPUnit\Framework\TestCase;


class RoverTest extends TestCase
{

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
        $this->coordinate = $this->getCoordinateMock();
        $this->direction = $this->getDirectionMock();
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
        $this->coordinate = $this->getCoordinateMock();
        $this->rover->setCoordinate($this->coordinate);
        $this->assertEquals($this->coordinate, $this->rover->getCoordinate());
    }

    /**
     * Test that setDirection function changes the direction of the rover
     */
    public function testThatSetDirectionChangesTheDirectionOfRover()
    {
        $this->direction = $this->getDirectionMock();
        $this->rover->setDirection($this->direction);
        $this->assertEquals($this->direction, $this->rover->getDirection());
    }

    /**
     * Mock Coordinate object
     * @return Coordinate
     */
    private function getCoordinateMock(): Coordinate
    {
        $coordinate = \Mockery::mock(Coordinate::class);
        return $coordinate;
    }

    /**
     * Mock Direction object
     * @return Direction
     */
    private function getDirectionMock(): Direction
    {
        $directionMock = \Mockery::mock(Direction::class);
        return $directionMock;
    }
}
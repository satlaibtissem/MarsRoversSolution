<?php
declare(strict_types=1);

namespace Test\Traits;

use App\Model\Coordinate;
use App\Model\Direction;
use App\Model\Plateau;
use App\Model\Rover;

trait ModelMokeryTrait
{

    /**
     * Mock Plateau object
     * @param Coordinate $lowerLeftCoordinate
     * @param Coordinate $upperRightCoordinate
     * @return Plateau
     */
    private function getPlateauMock(
        Coordinate $lowerLeftCoordinate = null,
        Coordinate $upperRightCoordinate = null
    ): Plateau
    {
        $plateau = \Mockery::mock(Plateau::class);
        if (isset($lowerLeftCoordinate))
            $plateau->shouldReceive('getLowerLeftCoordinate')
                ->andReturn($lowerLeftCoordinate);
        if (isset($upperRightCoordinate))
            $plateau->shouldReceive('getUpperRightCoordinate')
                ->andReturn($upperRightCoordinate);
        return $plateau;
    }

    /**
     * Mock Coordinate object
     * @param int $x
     * @param int $y
     * @return Coordinate
     */
    private function getCoordinateMock(int $x, int $y): Coordinate
    {
        $coordinate = \Mockery::mock(Coordinate::class);
        $coordinate->shouldReceive('getX')
            ->andReturn($x);
        $coordinate->shouldReceive('getY')
            ->andReturn($y);
        return $coordinate;
    }

    /**
     * Add setX expectation to coordinate mocked object
     * @param Coordinate $coordinate
     * @param int $x
     */
    private function addSetXExpectationToCoordinateMock(Coordinate $coordinate, int $x)
    {
        $coordinate->shouldReceive('setX')
            ->with($x)
            ->andReturnSelf();
    }

    /**
     * Add setX expectation to coordinate mocked object
     * @param Coordinate $coordinate
     * @param int $y
     */
    private function addSetYExpectationToCoordinateMock(Coordinate $coordinate, int $y)
    {
        $coordinate->shouldReceive('setY')
            ->with($y)
            ->andReturnSelf();
    }

    /**
     * Mock Rover object
     * @return Rover
     */
    private function getRoverMock(): Rover
    {
        $rover = \Mockery::mock(Rover::class);
        return $rover;
    }

    /**
     * Configure Rover coordinate methods expectation
     * @param Rover $rover
     * @param Coordinate $initalCoordinate
     */
    private function configureRoverCoordinateMethodsExpectation(Rover $rover, Coordinate $initalCoordinate)
    {
        $rover->shouldReceive('getCoordinate')
            ->andReturn($initalCoordinate);
        $rover->shouldReceive('setCoordinate')
            ->with($initalCoordinate)
            ->andReturnSelf();
    }

    /**
     * Configure Rover direction methods expectation
     * @param Rover $rover
     * @param Direction $initialDirection
     */
    private function configureRoverDirectionMethodsExpectation(Rover $rover, Direction $initialDirection)
    {
        $rover->shouldReceive('getDirection')
            ->andReturn($initialDirection);
        $rover->shouldReceive('setDirection')
            ->with($initialDirection)
            ->andReturnSelf();
    }

    /**
     * add toString method expectation to rover mock
     * @param Rover $rover
     * @param Coordinate $finalCoordinate
     * @param Direction $finalDirection
     */
    private function addToStringMethodExpectationToRoverMock(Rover $rover, Coordinate $finalCoordinate, Direction $finalDirection)
    {
        $rover->shouldReceive('toString')
            ->andReturn(
                $finalCoordinate->getX() . ' ' .
                $finalCoordinate->getY() . ' ' .
                $finalDirection->getOrientation()
            );
    }

    /**
     * Mock Direction object
     * @param string $direction
     * @return Direction
     */
    private function getDirectionMock(string $direction): Direction
    {
        $directionMock = \Mockery::mock(Direction::class);
        $directionMock->shouldReceive('getOrientation')
            ->andReturn($direction);
        return $directionMock;
    }

    /** add setOrientation method expectation to direction mocked object
     * @param Direction $direction
     * @param string $orientation
     */
    private function addSetOrientationExpectationToDirectionMock(Direction $direction, string $orientation)
    {
        $direction->shouldReceive('setOrientation')
            ->with($orientation)
            ->andReturnSelf();
    }

    /**
     * @param string $orientation
     * @param Coordinate $intialCoordinate
     * @param Coordinate $finalCoordinate
     * @param Direction $initialDirection
     * @param Coordinate $finalCoordinate
     * @return Rover
     */
    private function configureRoverMock(
        Coordinate $intialCoordinate,
        Coordinate $finalCoordinate,
        Direction $initialDirection,
        Direction $finalDirection
        ): Rover
    {
        $rover = $this->getRoverMock();
        $this->configureRoverCoordinateMethodsExpectation($rover, $intialCoordinate);
        $this->configureRoverDirectionMethodsExpectation($rover, $initialDirection);
        $this->addToStringMethodExpectationToRoverMock($rover, $finalCoordinate, $finalDirection);
        return $rover;
    }
}
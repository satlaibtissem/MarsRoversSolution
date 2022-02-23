<?php
namespace Test\Traits;

use App\Model\Coordinate;
use App\Model\Direction;
use App\Model\Plateau;
use App\Model\Rover;

trait ModelMokery
{

    /**
     * Mock Plateau object
     * @param Coordinate $lowerLeftCoordinate
     * @param Coordinate $upperRightCoordinate
     * @return Plateau
     */
    private function getPlateauMock(Coordinate $lowerLeftCoordinate, Coordinate $upperRightCoordinate): Plateau
    {
        $plateau = \Mockery::mock(Plateau::class);
        $plateau->shouldReceive('getLowerLeftCoordinate')
            ->andReturn($lowerLeftCoordinate);
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
     * Mock Rover object
     * @return Rover
     */
    private function getRoverMock(): Rover
    {
        $rover = \Mockery::mock(Rover::class);
        return $rover;
    }

    /**
     * Configure Rover coordinate
     * @param Rover $rover
     * @param Coordinate $initalCoordinate
     * @return Rover
     */
    private function configureRoverCoordinate(Rover $rover, Coordinate $initalCoordinate): Rover
    {
        $rover->shouldReceive('getCoordinate')
            ->andReturn($initalCoordinate);
        $rover->shouldReceive('setCoordinate')
            ->with($initalCoordinate)
            ->andReturnSelf();
        return $rover;
    }

    /**
     * Configure Rover direction
     * @param Rover $rover
     * @param Direction $initialDirection
     * @return Rover
     */
    private function configureRoverDirection(Rover $rover, Direction $initialDirection): Rover
    {
        $rover->shouldReceive('getDirection')
            ->andReturn($initialDirection);
        $rover->shouldReceive('setDirection')
            ->with($initialDirection)
            ->andReturnSelf();
        return $rover;
    }

    /**
     * mock toString rover function
     * @param Rover $rover
     * @param Coordinate $finalCoordinate
     * @param Direction $finalDirection
     * @return Rover
     */
    private function mockToStringRoverFunction(Rover $rover, Coordinate $finalCoordinate, Direction $finalDirection): Rover
    {
        $rover->shouldReceive('toString')
        ->andReturn(
            $finalCoordinate->getX() . ' ' .
            $finalCoordinate->getY() . ' ' .
            $finalDirection->getOrientation()
        );
        return $rover;
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

    /** Configure direction orientation
     * @param Direction $direction
     * @param string $orientation
     * @return Direction
     */
    private function configureDirectionOrientation(Direction $direction, string $orientation): Direction
    {
        $direction->shouldReceive('setOrientation')
            ->with($orientation)
            ->andReturnSelf();
        return $direction;
    }
}
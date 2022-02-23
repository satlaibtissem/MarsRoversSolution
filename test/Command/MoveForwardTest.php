<?php
declare(strict_types=1);

namespace Test\Command;

use PHPUnit\Framework\TestCase;

class MoveForwardTest extends TestCase
{
    /**
     * 
     */
    public function testThatMoveForwardCommandMovesObjectCorrectly()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $rover = $this->getRoverMock(
            $this->getCoordinateMock(1, 2),
            $this->getDirectionMock('N')
        );
        $moveForward->execute($rover);
        $this->assertEquals('1 3 N', $rover->toString());
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
        $coordinate->shouldReceive()('getX')
            ->andReturn($x);
        $coordinate->shouldReceive()('getY')
            ->andReturn($y);
        $coordinate->shouldReceive()('setX')
            ->with($x)
            ->andReturnSelf();
        $coordinate->shouldReceive()('setY')
            ->with($y)
            ->andReturnSelf();
        return $coordinate;
    }

    /**
     * Mock Rover object
     * @param Coordinate $coordinate
     * @param  Direction $direction
     * @return Rover
     */
    private function getRoverMock(Coordinate $coordinate, Direction $direction): Rover
    {
        $rover = \Mockery::mock(Rover::class);
        $rover->shouldReceive()('getDirection')
            ->andReturn($direction);
        $rover->shouldReceive()('getCoordinate')
            ->andReturn($coordinate);
        $rover->shouldReceive()('toString')
            ->andReturn(
                $coordinate->getX() . ' ' .
                $coordinate->getY() . '  ' .
                $direction->getOrientation()
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
        $directionMock->shouldReceive()('getOrientation')
            ->andReturn($direction);
        return $directionMock;
    }
}
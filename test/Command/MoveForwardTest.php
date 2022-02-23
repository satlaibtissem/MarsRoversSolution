<?php
declare(strict_types=1);

namespace Test\Command;

use Exception;
use PHPUnit\Framework\TestCase;

class MoveForwardTest extends TestCase
{
    /**
     * Test that MoveForward class is an instance of Command interface
     */
    public function testThatMoveForwardCommandIsAnInstanceOfCommandInterface()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $this->assertInstanceOf(Command::class, $moveForward);
    }

    /**
     * Test that execute a move forward gives the right results for north direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInNorthDirection()
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
     * Test that execute a move forward gives the right results for easth direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInEastDirection()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $rover = $this->getRoverMock(
            $this->getCoordinateMock(1, 2),
            $this->getDirectionMock('E')
        );
        $moveForward->execute($rover);
        $this->assertEquals('2 2 E', $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for south direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInSouthDirection()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $rover = $this->getRoverMock(
            $this->getCoordinateMock(1, 2),
            $this->getDirectionMock('S')
        );
        $moveForward->execute($rover);
        $this->assertEquals('1 1 S', $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for west direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInWestDirection()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $rover = $this->getRoverMock(
            $this->getCoordinateMock(2, 2),
            $this->getDirectionMock('W')
        );
        $moveForward->execute($rover);
        $this->assertEquals('1 2 W', $rover->toString());
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfMovementIsNotPossible()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $rover = $this->getRoverMock(
            $this->getCoordinateMock(1, 5),
            $this->getDirectionMock('N')
        );
        $this->expectException(Exception::class);
        $moveForward->execute($rover);
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
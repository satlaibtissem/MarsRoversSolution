<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\Command;
use App\Command\MoveForward;
use App\Model\Coordinate;
use App\Model\Direction;
use App\Model\Rover;
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
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(1, 3);
        $roverIntialCoordinate->shouldReceive('setY')
            ->with($roverFinalCoordinate->getY())
            ->andReturnSelf();
        $rover = $this->getRoverMock(
            $roverIntialCoordinate,
            $roverFinalCoordinate,
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
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(2, 2);
        $roverIntialCoordinate->shouldReceive('setX')
            ->with($roverFinalCoordinate->getX())
            ->andReturnSelf();
        $rover = $this->getRoverMock(
            $roverIntialCoordinate,
            $roverFinalCoordinate,
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
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(1, 1);
        $roverIntialCoordinate->shouldReceive('setY')
            ->with($roverFinalCoordinate->getY())
            ->andReturnSelf();
        $rover = $this->getRoverMock(
            $roverIntialCoordinate,
            $roverFinalCoordinate,
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
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(0, 2);
        $roverIntialCoordinate->shouldReceive('setX')
            ->with($roverFinalCoordinate->getX())
            ->andReturnSelf();
        $rover = $this->getRoverMock(
            $roverIntialCoordinate,
            $roverFinalCoordinate,
            $this->getDirectionMock('W')
        );
        $moveForward->execute($rover);
        $this->assertEquals('0 2 W', $rover->toString());
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIsGreaterThanUpperBordersRightYCoordinate()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $coordinate = $this->getCoordinateMock(1, 5);
        $rover = $this->getRoverMock(
            $coordinate,
            $coordinate,
            $this->getDirectionMock('N')
        );
        $this->expectException(Exception::class);
        $moveForward->execute($rover);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIsGreaterThanBordersUpperRightXCoordinate()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $coordinate = $this->getCoordinateMock(5, 1);
        $rover = $this->getRoverMock(
            $coordinate,
            $coordinate,
            $this->getDirectionMock('E')
        );
        $this->expectException(Exception::class);
        $moveForward->execute($rover);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIslessThanBordersLowerLeftYCoordinate()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $coordinate = $this->getCoordinateMock(1, 0);
        $rover = $this->getRoverMock(
            $coordinate,
            $coordinate,
            $this->getDirectionMock('S')
        );
        $this->expectException(Exception::class);
        $moveForward->execute($rover);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIslessThanBordersLowerLeftXCoordinate()
    {
        $moveForward = new MoveForward($this->getCoordinateMock(5, 5));
        $coordinate = $this->getCoordinateMock(0, 1);
        $rover = $this->getRoverMock(
            $coordinate,
            $coordinate,
            $this->getDirectionMock('W')
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
        $coordinate->shouldReceive('getX')
            ->andReturn($x);
        $coordinate->shouldReceive('getY')
            ->andReturn($y);
        return $coordinate;
    }

    /**
     * Mock Rover object
     * @param Coordinate $initalCoordinate
     * @param Coordinate $coordinate
     * @param  Direction $finalCoordinate
     * @return Rover
     */
    private function getRoverMock(Coordinate $initalCoordinate, Coordinate $finalCoordinate, Direction $direction): Rover
    {
        $rover = \Mockery::mock(Rover::class);
        $rover->shouldReceive('getDirection')
            ->andReturn($direction);
        $rover->shouldReceive('getCoordinate')
            ->andReturn($initalCoordinate);
        $rover->shouldReceive('setCoordinate')
            ->with($initalCoordinate)
            ->andReturnSelf();
        $rover->shouldReceive('toString')
            ->andReturn(
                $finalCoordinate->getX() . ' ' .
                $finalCoordinate->getY() . ' ' .
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
        $directionMock->shouldReceive('getOrientation')
            ->andReturn($direction);
        return $directionMock;
    }
}
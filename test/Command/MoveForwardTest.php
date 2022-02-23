<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\Command;
use App\Command\MoveForward;
use App\Model\Coordinate;
use App\Model\Rover;
use Exception;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokery;

class MoveForwardTest extends TestCase
{
    use ModelMokery;

     /**
     * @var MoveForward
     */
    private $moveForward;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $this->moveForward = new MoveForward($this->getPlateauMock($lowerLeftCoordinate, $upperRightCoordinate));
    }

    /**
     * Test that MoveForward class is an instance of Command interface
     */
    public function testThatMoveForwardCommandIsAnInstanceOfCommandInterface()
    {
        $this->assertInstanceOf(Command::class, $this->moveForward);
    }

    /**
     * Test that execute a move forward gives the right results for north direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInNorthDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(1, 3);
        $rover = $this->configureRoverPosition('N', $roverIntialCoordinate, $roverFinalCoordinate);  
        $this->assertEquals('1 3 N', $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for easth direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInEastDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(2, 2);
        $rover = $this->configureRoverPosition('E', $roverIntialCoordinate, $roverFinalCoordinate); 
        $this->assertEquals('2 2 E', $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for south direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInSouthDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(1, 1);
        $rover = $this->configureRoverPosition('S', $roverIntialCoordinate, $roverFinalCoordinate); 
        $this->assertEquals('1 1 S', $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for west direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInWestDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(0, 2);
        $rover = $this->configureRoverPosition('W', $roverIntialCoordinate, $roverFinalCoordinate); 
        $this->assertEquals('0 2 W', $rover->toString());
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIsGreaterThanUpperBordersRightYCoordinate()
    {
        $coordinate = $this->getCoordinateMock(1, 5);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverPosition('N', $coordinate, $coordinate);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIsGreaterThanBordersUpperRightXCoordinate()
    {
        $coordinate = $this->getCoordinateMock(5, 1);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverPosition('E', $coordinate, $coordinate);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIslessThanBordersLowerLeftYCoordinate()
    {
        $coordinate = $this->getCoordinateMock(1, 0);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverPosition('S', $coordinate, $coordinate);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIslessThanBordersLowerLeftXCoordinate()
    {
        $coordinate = $this->getCoordinateMock(0, 1);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverPosition('W', $coordinate, $coordinate);
    }

    /**
     * @param string $orientation
     * @param Coordinate $roverIntialCoordinate
     * @param Coordinate $roverFinalCoordinate
     * @return Rover
     */
    private function configureRoverPosition(string $orientation, Coordinate $roverIntialCoordinate, Coordinate $roverFinalCoordinate): Rover
    {
        $roverIntialCoordinate->shouldReceive('setY')
            ->with($roverFinalCoordinate->getY())
            ->andReturnSelf();
        $roverIntialCoordinate->shouldReceive('setX')
            ->with($roverFinalCoordinate->getX())
            ->andReturnSelf();
        $rover = $this->getRoverMock();
        $roverDirection = $this->getDirectionMock($orientation);
        $rover = $this->configureRoverCoordinate($rover, $roverIntialCoordinate);
        $rover = $this->configureRoverDirection($rover, $roverDirection);
        $rover = $this->mockToStringRoverFunction($rover, $roverFinalCoordinate, $roverDirection);
        $this->moveForward->execute($rover);
        return $rover;
    }
}
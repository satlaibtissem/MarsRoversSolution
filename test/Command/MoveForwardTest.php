<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\CommandInterface;
use App\Command\MoveForward;
use App\Data\DirectionTypes;
use App\Model\Coordinate;
use App\Model\Rover;
use Exception;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class MoveForwardTest extends TestCase
{
    use ModelMokeryTrait;

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
        $this->moveForward = new MoveForward(
            $this->getPlateauMock(
                $lowerLeftCoordinate,
                $upperRightCoordinate
                )
            );
    }

    /**
     * Test that MoveForward class is an instance of Command interface
     */
    public function testThatMoveForwardCommandIsAnInstanceOfCommandInterface()
    {
        $this->assertInstanceOf(CommandInterface::class, $this->moveForward);
    }

    /**
     * Test that execute a move forward gives the right results for north direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInNorthDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(1, 3);
        $rover = $this->configureRoverMock(
            DirectionTypes::NORTH,
            $roverIntialCoordinate,
            $roverFinalCoordinate
        );  
        $this->assertEquals('1 3 ' . DirectionTypes::NORTH, $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for easth direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInEastDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(2, 2);
        $rover = $this->configureRoverMock(
            DirectionTypes::EAST,
            $roverIntialCoordinate,
            $roverFinalCoordinate
        ); 
        $this->assertEquals('2 2 ' . DirectionTypes::EAST, $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for south direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInSouthDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(1, 1);
        $rover = $this->configureRoverMock(
            DirectionTypes::SOUTH,
            $roverIntialCoordinate,
            $roverFinalCoordinate
        ); 
        $this->assertEquals('1 1 ' . DirectionTypes::SOUTH, $rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for west direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInWestDirection()
    {
        $roverIntialCoordinate = $this->getCoordinateMock(1, 2);
        $roverFinalCoordinate = $this->getCoordinateMock(0, 2);
        $rover = $this->configureRoverMock(DirectionTypes::WEST, $roverIntialCoordinate, $roverFinalCoordinate); 
        $this->assertEquals('0 2 ' . DirectionTypes::WEST, $rover->toString());
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIsGreaterThanUpperBordersRightYCoordinate()
    {
        $coordinate = $this->getCoordinateMock(1, 5);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverMock(DirectionTypes::NORTH, $coordinate, $coordinate);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIsGreaterThanBordersUpperRightXCoordinate()
    {
        $coordinate = $this->getCoordinateMock(5, 1);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverMock(DirectionTypes::EAST, $coordinate, $coordinate);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIslessThanBordersLowerLeftYCoordinate()
    {
        $coordinate = $this->getCoordinateMock(1, 0);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverMock(DirectionTypes::SOUTH, $coordinate, $coordinate);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIslessThanBordersLowerLeftXCoordinate()
    {
        $coordinate = $this->getCoordinateMock(0, 1);
        $this->expectException(Exception::class);
        $rover = $this->configureRoverMock(DirectionTypes::WEST, $coordinate, $coordinate);
    }

    /**
     * @param string $orientation
     * @param Coordinate $roverIntialCoordinate
     * @param Coordinate $roverFinalCoordinate
     * @return Rover
     */
    private function configureRoverMock(string $orientation, Coordinate $roverIntialCoordinate, Coordinate $roverFinalCoordinate): Rover
    {
        $roverIntialCoordinate->shouldReceive('setY')
            ->with($roverFinalCoordinate->getY())
            ->andReturnSelf();
        $roverIntialCoordinate->shouldReceive('setX')
            ->with($roverFinalCoordinate->getX())
            ->andReturnSelf();
        $rover = $this->getRoverMock();
        $roverDirection = $this->getDirectionMock($orientation);
        $rover = $this->configureRoverCoordinateMethodsExpectation($rover, $roverIntialCoordinate);
        $rover = $this->configureRoverDirectionMethodsExpectation($rover, $roverDirection);
        $rover = $this->addToStringMethodExpectationToRoverMock($rover, $roverFinalCoordinate, $roverDirection);
        $this->moveForward->execute($rover);
        return $rover;
    }
}
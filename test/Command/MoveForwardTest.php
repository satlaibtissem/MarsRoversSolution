<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\CommandInterface;
use App\Command\MoveForward;
use App\Data\DirectionTypes;
use App\Model\Rover;
use Exception;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class MoveForwardTest extends TestCase
{
    use ModelMokeryTrait;

    /**
     * @var Rover
     */
    private $rover;
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
        $this->moveForward(1, 2, 1, 3, DirectionTypes::NORTH);
        $this->assertEquals('1 3 ' . DirectionTypes::NORTH, $this->rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for easth direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInEastDirection()
    {
        $this->moveForward(1, 2, 2, 2, DirectionTypes::EAST);
        $this->assertEquals('2 2 ' . DirectionTypes::EAST, $this->rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for south direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInSouthDirection()
    {
        $this->moveForward(1, 2, 1, 1, DirectionTypes::SOUTH);
        $this->assertEquals('1 1 ' . DirectionTypes::SOUTH, $this->rover->toString());
    }

    /**
     * Test that execute a move forward gives the right results for west direction
     */
    public function testThatMoveForwardCommandMovesObjectCorrectlyInWestDirection()
    {
        $this->moveForward(1, 2, 0, 2, DirectionTypes::WEST);
        $this->assertEquals('0 2 ' . DirectionTypes::WEST, $this->rover->toString());
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIsGreaterThanUpperBordersRightYCoordinate()
    {
        $this->expectException(Exception::class);
        $this->moveForward(1, 5, 1, 5, DirectionTypes::NORTH);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIsGreaterThanBordersUpperRightXCoordinate()
    {
        $this->expectException(Exception::class);
        $this->moveForward(5, 1, 5, 1, DirectionTypes::WEST);        
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfYCoordinateIslessThanBordersLowerLeftYCoordinate()
    {
        $this->expectException(Exception::class);
        $this->moveForward(1, 0, 1, 0, DirectionTypes::SOUTH);
    }

    /**
     * Test that execute function throws an exception if can't execute movement
     */
    public function testThatExecuteThrowsExceptionIfXCoordinateIslessThanBordersLowerLeftXCoordinate()
    {
        $this->expectException(Exception::class);
        $this->moveForward(0, 1, 0, 1, DirectionTypes::WEST);
    }

    /**
     * Execute move forward command
     * @param int $initialX
     * @param int $initialY
     * @param int $finalX
     * @param int $finalY
     * @param string $orientation
     */
    private function moveForward(int $initialX, int $initialY, int $finalX, int $finalY, string $orientation)
    {
        $roverIntialCoordinate = $this->getCoordinateMock($initialX, $initialY);
        $roverFinalCoordinate = $this->getCoordinateMock($finalX, $finalY);
        if ($initialX !==  $finalX)
            $this->addSetXExpectationToCoordinateMock($roverIntialCoordinate, $finalX);
        if ($initialY !==  $finalY)
            $this->addSetYExpectationToCoordinateMock($roverIntialCoordinate, $finalY);
        $direction = $this->getDirectionMock($orientation);
        $this->rover = $this->configureRoverMock(
            $roverIntialCoordinate,
            $roverFinalCoordinate,
            $direction,
            $direction
        );
        $this->moveForward->execute($this->rover);
    }
}
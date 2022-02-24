<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\CommandInterface;
use App\Command\Rotatable;
use App\Command\RotateLeft;
use App\Data\DirectionTypes;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class RotateLeftTest extends TestCase
{
    use ModelMokeryTrait;

    /**
     * @var RotateLeft
     */
    private $rotateLeft;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->rotateLeft = new RotateLeft();
    }

    /**
     * Test that RotateLeft class is an instance of Command interface
     */
    public function testThatRotateLeftCommandIsAnInstanceOfCommandInterface()
    {
        $this->assertInstanceOf(CommandInterface::class, $this->rotateLeft);
    }

    /**
     * Test that RotateLeft class is an instance of Command interface
     */
    public function testThatRotateLeftCommandIsAnInstanceOfRotatbleAbstractClass()
    {
        $this->assertInstanceOf(Rotatable::class, $this->rotateLeft);
    }

    /**
     * Test that execute a rotation left gives the right results for north direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForNorthDirection()
    {
        $rover = $this->configureRoverMock(DirectionTypes::NORTH, DirectionTypes::WEST);
        $this->assertEquals('1 1 ' . DirectionTypes::WEST, $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForEastDirection()
    {
        $rover = $this->configureRoverMock(DirectionTypes::EAST, DirectionTypes::NORTH);
        $this->assertEquals('1 1 ' . DirectionTypes::NORTH, $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for south direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForSouthDirection()
    {
        $rover = $this->configureRoverMock(DirectionTypes::SOUTH, DirectionTypes::EAST);
        $this->assertEquals('1 1 ' . DirectionTypes::EAST, $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for west direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForWestDirection()
    {
        $rover = $this->configureRoverMock(DirectionTypes::WEST, DirectionTypes::SOUTH);
        $this->assertEquals('1 1 ' . DirectionTypes::SOUTH, $rover->toString());
    }

    /**
     * @param string $initialDirection
     * @param string $finalDirection
     * @return Rover
     */
    private function configureRoverMock(string $initialDirection, string $finalDirection): Rover
    {
        $rover = $this->getRoverMock();
        $roverInitialDirection = $this->getDirectionMock($initialDirection);
        $roverInitialDirection = $this->addSetOrientationExpectationToDirectionMock(
            $roverInitialDirection,
            $finalDirection
        );
        $rover = $this->configureRoverDirectionMethodsExpectation(
            $rover,
            $roverInitialDirection
        );
        $this->rotateLeft->execute($rover);
        $rover = $this->addToStringMethodExpectationToRoverMock(
            $rover,
            $this->getCoordinateMock(1, 1),
            $this->getDirectionMock($finalDirection)
        );
        return $rover;
    }
}
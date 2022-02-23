<?php

namespace Test\Command;

use App\Command\Command;
use App\Command\Rotatable;
use App\Command\RotateLeft;
use App\Model\Direction;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokery;

class RotateLeftTest extends TestCase
{
    use ModelMokery;

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
        $this->assertInstanceOf(Command::class, $this->rotateLeft);
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
        $rover = $this->getRoverAfterRotation('N', 'W');
        $this->assertEquals('1 1 W', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForEastDirection()
    {
        $rover = $this->getRoverAfterRotation('E', 'N');
        $this->assertEquals('1 1 N', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for south direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForSouthDirection()
    {
        $rover = $this->getRoverAfterRotation('S', 'E');
        $this->assertEquals('1 1 E', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for west direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForWestDirection()
    {
        $rover = $this->getRoverAfterRotation('W', 'S');
        $this->assertEquals('1 1 S', $rover->toString());
    }

    /**
     * @param string $initialDirection
     * @param string $finalDirection
     * @return Rover
     */
    private function getRoverAfterRotation(string $initialDirection, string $finalDirection): Rover
    {
        $rover = $this->getRoverMock();
        $roverInitialDirection = $this->getDirectionMock($initialDirection);
        $roverInitialDirection = $this->configureDirectionOrientation($roverInitialDirection, $finalDirection);
        $rover = $this->configureRoverDirection($rover, $roverInitialDirection);
        $this->rotateLeft->execute($rover);
        $rover = $this->mockToStringRoverFunction(
            $rover,
            $this->getCoordinateMock(1, 1),
            $this->getDirectionMock($finalDirection)
        );
        return $rover;
    }
}
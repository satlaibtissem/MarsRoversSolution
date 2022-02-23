<?php

namespace Test\Command;

use App\Command\Command;
use App\Command\Rotatable;
use App\Command\RotateLeft;
use App\Model\Direction;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;

class RotateLeftTest extends TestCase
{
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
        $initialDirection = $this->getDirectionMock($initialDirection);
        $initialDirection->shouldReceive('setOrientation')
            ->with($finalDirection)
            ->andReturnSelf();        
        $rover->shouldReceive('getDirection')
            ->andReturn($initialDirection);
        $rover->shouldReceive('setDirection')
            ->with($initialDirection)
            ->andReturnSelf();
        $this->rotateLeft->execute($rover);
        $rover->shouldReceive('toString')
            ->andReturn('1 1 ' . $finalDirection);
        return $rover;
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
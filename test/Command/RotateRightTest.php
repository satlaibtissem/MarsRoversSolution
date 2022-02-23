<?php

namespace Test\Command;

use App\Model\Direction;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;

class RotateRightTest extends TestCase
{
    /**
     * @var RotateRight
     */
    private $rotateRight;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->rotateRight = new RotateRight();
    }

    /**
     * Test that RotateRight class is an instance of Command interface
     */
    public function testThatRotateRightCommandIsAnInstanceOfCommandInterface()
    {
        $this->assertInstanceOf(Command::class, $this->rotateRight);
    }

    /**
     * Test that RotateRight class is an instance of Command interface
     */
    public function testThatRotateRightCommandIsAnInstanceOfRotatbleAbstractClass()
    {
        $this->assertInstanceOf(Rotatable::class, $this->rotateRight);
    }

    /**
     * Test that execute a rotation left gives the right results for north direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForNorthDirection()
    {
        $rover = $this->getRoverAfterRotation('N', 'E');
        $this->assertEquals('1 1 E', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForEastDirection()
    {
        $rover = $this->getRoverAfterRotation('E', 'N');
        $this->assertEquals('1 1 N', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for south direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForSouthDirection()
    {
        $rover = $this->getRoverAfterRotation('S', 'W');
        $this->assertEquals('1 1 W', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for west direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForWestDirection()
    {
        $rover = $this->getRoverAfterRotation('W', 'N');
        $this->assertEquals('1 1 N', $rover->toString());
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
        $this->rotateRight->execute($rover);
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
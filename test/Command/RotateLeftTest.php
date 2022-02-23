<?php

namespace Test\Command;

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
        $rover = $this->getRoverMock();
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('N'));
        $rover->shouldReceive('setDirection')
            ->with($this->getDirectionMock('W'))
            ->andReturnSelf();
        $this->rotateLeft->execute($rover);
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('W'));
        $this->assertEquals('W', $rover->getDirection()->getOrientation());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForEastDirection()
    {
        $rover = $this->getRoverMock();
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('E'));
        $rover->shouldReceive('setDirection')
            ->with($this->getDirectionMock('N'))
            ->andReturnSelf();
        $this->rotateLeft->execute($rover);
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('N'));
        $this->assertEquals('N', $rover->getDirection()->getOrientation());;
    }

    /**
     * Test that execute a rotation left gives the right results for south direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForSouthDirection()
    {
        $rover = $this->getRoverMock();
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('S'));
        $rover->shouldReceive('setDirection')
            ->with($this->getDirectionMock('E'))
            ->andReturnSelf();
        $this->rotateLeft->execute($rover);
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('E'));
        $this->assertEquals('E', $rover->getDirection()->getOrientation());
    }

    /**
     * Test that execute a rotation left gives the right results for west direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForWestDirection()
    {
        $rover = $this->getRoverMock();
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('W'));
        $rover->shouldReceive('setDirection')
            ->with($this->getDirectionMock('S'))
            ->andReturnSelf();
        $this->rotateLeft->execute($rover);
        $rover->shouldReceive('getDirection')
            ->andReturn($this->getDirectionMock('S'));
        $this->assertEquals('S', $rover->getDirection()->getOrientation());
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
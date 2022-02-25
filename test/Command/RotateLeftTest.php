<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\CommandInterface;
use App\Command\Rotatable;
use App\Command\RotateLeft;
use App\Data\DirectionTypes;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\RotatableTrait;

class RotateLeftTest extends TestCase
{
    use RotatableTrait;

    /**
     * @var Rover
     */
    private $rover;
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
        $this->rotate(
            $this->rotateLeft,
            1,
            1,
            DirectionTypes::NORTH,
            DirectionTypes::WEST
        );
        $this->assertEquals('1 1 ' . DirectionTypes::WEST, $this->rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForEastDirection()
    {
        $this->rotate(
            $this->rotateLeft,
            1,
            1,
            DirectionTypes::EAST,
            DirectionTypes::NORTH
        );
        $this->assertEquals('1 1 ' . DirectionTypes::NORTH, $this->rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for south direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForSouthDirection()
    {
        $this->rotate(
            $this->rotateLeft,
            1,
            1,
            DirectionTypes::SOUTH,
            DirectionTypes::EAST
        );
        $this->assertEquals('1 1 ' . DirectionTypes::EAST, $this->rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for west direction
     */
    public function testThatRotateLeftCommandReturnsTheRightDirectionForWestDirection()
    {
        $this->rotate(
            $this->rotateLeft,
            1,
            1,
            DirectionTypes::WEST,
            DirectionTypes::SOUTH
        );
        $this->assertEquals('1 1 ' . DirectionTypes::SOUTH, $this->rover->toString());
    }
}
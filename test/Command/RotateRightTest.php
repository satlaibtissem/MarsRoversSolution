<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\CommandInterface;
use App\Command\Rotatable;
use App\Command\RotateRight;
use App\Data\DirectionTypes;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Command\Traits\RotatableTrait;

class RotateRightTest extends TestCase
{
    use RotatableTrait;

    /**
     * @var Rover
     */
    private $rover;
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
        $this->assertInstanceOf(CommandInterface::class, $this->rotateRight);
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
        $this->rotate(
            $this->rotateRight,
            1,
            1,
            DirectionTypes::NORTH,
            DirectionTypes::EAST
        );
        $this->assertEquals('1 1 ' . DirectionTypes::EAST, $this->rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForEastDirection()
    {
        $this->rotate(
            $this->rotateRight,
            1,
            1,
            DirectionTypes::EAST,
            DirectionTypes::SOUTH
        );
        $this->assertEquals('1 1 ' . DirectionTypes::SOUTH, $this->rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for south direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForSouthDirection()
    {
        $this->rotate(
            $this->rotateRight,
            1,
            1,
            DirectionTypes::SOUTH,
            DirectionTypes::WEST
        );
        $this->assertEquals('1 1 ' . DirectionTypes::WEST, $this->rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for west direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForWestDirection()
    {
        $this->rotate(
            $this->rotateRight,
            1,
            1,
            DirectionTypes::WEST,
            DirectionTypes::NORTH
        );
        $this->assertEquals('1 1 ' . DirectionTypes::NORTH, $this->rover->toString());
    }
}
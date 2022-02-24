<?php
declare(strict_types=1);

namespace Test\Command;

use App\Command\CommandInterface;
use App\Command\Rotatable;
use App\Command\RotateRight;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class RotateRightTest extends TestCase
{
    use ModelMokeryTrait;

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
        $rover = $this->getRoverAfterRotation('N', 'E');
        $this->assertEquals('1 1 E', $rover->toString());
    }

    /**
     * Test that execute a rotation left gives the right results for easth direction
     */
    public function testThatRotateRightCommandReturnsTheRightDirectionForEastDirection()
    {
        $rover = $this->getRoverAfterRotation('E', 'S');
        $this->assertEquals('1 1 S', $rover->toString());
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
        $roverInitialDirection = $this->getDirectionMock($initialDirection);
        $roverInitialDirection = $this->configureDirectionOrientation($roverInitialDirection, $finalDirection);
        $rover = $this->configureRoverDirection($rover, $roverInitialDirection);
        $this->rotateRight->execute($rover);
        $rover = $this->mockToStringRoverFunction(
            $rover,
            $this->getCoordinateMock(1, 1),
            $this->getDirectionMock($finalDirection)
        );
        return $rover;
    }
}
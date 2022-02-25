<?php
declare(strict_types=1);
namespace Test\Command;

use App\Command\CommandFactory;
use App\Command\FactoryInterface;
use App\Command\MoveForward;
use App\Command\RotateLeft;
use App\Command\RotateRight;
use App\Data\CommandTypes;
use Exception;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class CommandFactoryTest extends TestCase
{
    use ModelMokeryTrait;

    /**
     * @var CommandFactory
     */
    private $factory;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->factory = new CommandFactory();
    }

    /**
     * Test that CommandFactory class is an instance of Factory interface
     */
    public function testThatCommandFactoryIsAnInstanceOfFctoryInterface()
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->factory);
    }

    /**
     * Test that create command function creates MoveForward Command
     */
    public function testThatCreateCommandCreatesMoveForwardCommand()
    {
        $lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $this->assertInstanceOf(
            MoveForward::class,
            $this->factory->createCommand(
                CommandTypes::MOVE_FORWARD,
                [$this->getPlateauMock($lowerLeftCoordinate, $upperRightCoordinate)]
            )
        );
    }

    /**
     * Test that create command function creates RotateLeft Command
     */
    public function testThatCreateCommandCreatesRotateLeftCommand()
    {
        $this->assertInstanceOf(
            RotateLeft::class,
            $this->factory->createCommand(CommandTypes::ROTATE_LEFT)
        );
    }

    /**
     * Test that create command function creates RotateRigth Command
     */
    public function testThatCreateCommandCreatesRotateRightCommand()
    {
        $this->assertInstanceOf(
            RotateRight::class,
            $this->factory->createCommand(CommandTypes::ROTATE_RIGHT)
        );
    }

    /**
     * Test that create command function throws exception if command types is unsupported
     */
    public function testThatCreateCommandThrowsExceptionForUnsupportedCommand()
    {
        $this->expectException(Exception::class);
        $this->factory->createCommand('S');
    }

    /**
     * Test that create command function throws exception if we don't pass arguments
     */
    public function testThatCreateCommandThrowsExceptionIfNoArgsArePassed()
    {
        $this->expectException(Exception::class);
        $this->factory->createCommand(CommandTypes::MOVE_FORWARD);
    }
}
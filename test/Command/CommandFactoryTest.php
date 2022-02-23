<?php

namespace Test\Command;

use App\Command\MoveForward;
use App\Command\RotateLeft;
use App\Command\RotateRight;
use App\Data\CommandTypes;
use Exception;
use PHPUnit\Framework\TestCase;

class CommandFactoryTest extends TestCase
{
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
        $this->assertInstanceOf(Factory::class, $this->factory);
    }

    /**
     * Test that create command function creates MoveForward Command
     */
    public function testThatCreateCommandCreatesMoveForwardCommand()
    {
        $this->assertInstanceOf(MoveForward::class, $this->factory->createCommand(CommandTypes::MOVE_FORWARD));
    }

    /**
     * Test that create command function creates RotateLeft Command
     */
    public function testThatCreateCommandCreatesRotateLeftCommand()
    {
        $this->assertInstanceOf(RotateLeft::class, $this->factory->createCommand(CommandTypes::ROTATE_LEFT));
    }

    /**
     * Test that create command function creates RotateRigth Command
     */
    public function testThatCreateCommandCreatesRotateRightCommand()
    {
        $this->assertInstanceOf(RotateRight::class, $this->factory->createCommand(CommandTypes::ROTATE_RIGHT));
    }

    /**
     * Test that create command function throws exception if command types is unsupported
     */
    public function testThatCreateCommandThrowsExceptionForUnsupportedCommand()
    {
        $this->expectException(Exception::class);
        $this->factory->createCommand('S');
    }
}
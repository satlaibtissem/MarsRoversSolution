<?php
declare(strict_types=1);

namespace Test\Invoker;

use App\Command\CommandInterface;
use App\Command\FactoryInterface;
use App\Data\CommandTypes;
use App\Data\DirectionTypes;
use App\Invoker\CommandExecuter;
use App\Invoker\InvokerInterface;
use App\Model\Plateau;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class CommandExecuterTest extends TestCase
{
    use ModelMokeryTrait;

    /**
     * @var Rover
     */
    private $rover;

    /**
     * Test that CommandExecuter class is an instance of Invoker interface
     */
    public function testThatCommandExecuterIsAnInstanceOfInvokerInterface()
    {
        $commandExecuter = new CommandExecuter(\Mockery::mock(FactoryInterface::class));
        $this->assertInstanceOf(InvokerInterface::class, $commandExecuter);
    }

    /**
     * Test that CommandExecuter class gives the right results for MoveForward Command
     */
    public function testThatExecuteCommandGivesTheRightResultsForMoveForwardCommand()
    {
        $lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $plateau = $this->getPlateauMock($lowerLeftCoordinate, $upperRightCoordinate);
        $this->executeCommand(
            CommandTypes::MOVE_FORWARD,
            1, 2,
            DirectionTypes::NORTH,
            $plateau
        );
        $this->assertEquals('1 2 ' . DirectionTypes::NORTH, $this->rover->toString());
    }

    /**
     * Test that CommandExecuter class gives the right results for RotateLeft Command
     */
    public function testThatExecuteCommandGivesTheRightResultsForRotateLeftCommand()
    {
        $this->executeCommand(
            CommandTypes::ROTATE_LEFT,
            1, 2,
            DirectionTypes::WEST,
            $this->getPlateauMock()
        );
        $this->assertEquals('1 2 ' . DirectionTypes::WEST, $this->rover->toString());
    }

    /**
     * Test that CommandExecuter class gives the right results for RotateRight Command
     */
    public function testThatExecuteCommandGivesTheRightResultsForRotateRightCommand()
    {
        $this->executeCommand(
            CommandTypes::ROTATE_RIGHT,
            1, 2,
            DirectionTypes::EAST,
            $this->getPlateauMock()
        );
        $this->assertEquals('1 2 ' . DirectionTypes::EAST, $this->rover->toString());
    }

    /**
     * Mock Factory interface
     * @param string $commandType
     * @param array $args
     * @return FactoryInterface
     */
    private function getFactoryMock(string $commandType, array $args = []): FactoryInterface
    {
        $factory = \Mockery::mock(FactoryInterface::class);
        $factory->shouldReceive('createCommand')
            ->with(
                $commandType,
                $args
            )
            ->andReturn($this->getCommandInterfaceMock());
        return $factory;
    }

    /**
     * @return CommandInterface
     */
    private function getCommandInterfaceMock(): CommandInterface
    {
        $command = \Mockery::mock(CommandInterface::class);
        $command->shouldReceive('execute')
            ->with($this->rover)
            ->andReturnSelf();
        return $command;
    }

    /**
     * Configure rover mock
     * @param string $commandType
     * @param int $x
     * @param int $y
     * @param string $orientation
     * @param Plateau $plateau
     */
    private function executeCommand(
        string $commandType,
        int $x,
        int $y,
        string $orientation,
        Plateau $plateau
    )
    {
        $coordinate = $this->getCoordinateMock($x, $y);
        $direction = $this->getDirectionMock($orientation);
        $this->rover = $this->configureRoverMock(
            $coordinate,
            $coordinate,
            $direction,
            $direction
        );
        $factory = $this->getFactoryMock($commandType, ['plateau' => $plateau]);
        $commandExecuter = new CommandExecuter($factory);
        $commandExecuter->executeCommand($commandType, $this->rover, $plateau);
    }
}

<?php
declare(strict_types=1);

namespace Test\Invoker;

use App\Command\CommandInterface;
use App\Command\FactoryInterface;
use App\Data\CommandTypes;
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
     * Test that CommandExecuter class is an instance of Invoker interface
     */
    public function testThatCommandExecuterIsAnInstanceOfInvokerInterface()
    {
        $commandExecuter = new CommandExecuter($this->getFactoryMock());
        $this->assertInstanceOf(InvokerInterface::class, $commandExecuter);
    }

    /**
     * Test that CommandExecuter class gives the right results for MoveForward Command
     */
    public function testThatExecuteCommandGivesTheRightResultsForMoveForwardCommand()
    {
        $factory = $this->getFactoryMock();
        $lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $rover = $this->configureRoverPosition(1, 2, 'N');
        $plateau = $this->getPlateauMock($lowerLeftCoordinate, $upperRightCoordinate);
        $factory->shouldReceive('createCommand')
            ->with(
                CommandTypes::MOVE_FORWARD,
                ['plateau' => $plateau]
            )
            ->andReturn($this->getCommandMock($rover));
        
        $commandExecuter = new CommandExecuter($factory);
        $commandExecuter->executeCommand(CommandTypes::MOVE_FORWARD, $rover, $plateau);
        $this->assertEquals('1 2 N', $rover->toString());
    }

    /**
     * Test that CommandExecuter class gives the right results for RotateLeft Command
     */
    public function testThatExecuteCommandGivesTheRightResultsForRotateLeftCommand()
    {
        $factory = $this->getFactoryMock();
        $rover = $this->configureRoverPosition(1, 2, 'W');
        $plateau = \Mockery::mock(Plateau::class);
        $factory->shouldReceive('createCommand')
            ->with(
                CommandTypes::ROTATE_LEFT,
                ['plateau' => $plateau]
            )
            ->andReturn($this->getCommandMock($rover));
        
        $commandExecuter = new CommandExecuter($factory);
        $commandExecuter->executeCommand(CommandTypes::ROTATE_LEFT, $rover, $plateau);
        $this->assertEquals('1 2 W', $rover->toString());
    }

    /**
     * Test that CommandExecuter class gives the right results for RotateRight Command
     */
    public function testThatExecuteCommandGivesTheRightResultsForRotateRightCommand()
    {
        $factory = $this->getFactoryMock();
        $rover = $this->configureRoverPosition(1, 2, 'E');
        $plateau = \Mockery::mock(Plateau::class);
        $factory->shouldReceive('createCommand')
            ->with(
                CommandTypes::ROTATE_RIGHT,
                ['plateau' => $plateau]
            )
            ->andReturn($this->getCommandMock($rover));
        
        $commandExecuter = new CommandExecuter($factory);
        $commandExecuter->executeCommand(CommandTypes::ROTATE_RIGHT, $rover, $plateau);
        $this->assertEquals('1 2 E', $rover->toString());
    }

    /**
     * Mock Factory interface
     */
    private function getFactoryMock(): FactoryInterface
    {
        return \Mockery::mock(FactoryInterface::class);
    }

    /**
     * @param Rover $rover
     * @return CommandInterface
     */
    private function getCommandMock(Rover $rover): CommandInterface
    {
        $moveForward = \Mockery::mock(CommandInterface::class);
        $moveForward->shouldReceive('execute')
            ->with($rover)
            ->andReturnSelf();
        return $moveForward;
    }

    /**
     * Configure rover position
     * @param int $x
     * @param int $y
     * @param string $orientation
     * @return Rover
     */
    private function configureRoverPosition(int $x, int $y, string $orientation): Rover
    {
        $rover = $this->getRoverMock();
        $coordinate = $this->getCoordinateMock($x, $y);
        $direction = $this->getDirectionMock($orientation);
        $rover = $this->configureRoverCoordinate($rover, $coordinate);
        $rover = $this->configureRoverDirection($rover, $direction);
        $rover = $this->mockToStringRoverFunction($rover, $coordinate, $direction);
        return $rover;
    }
}

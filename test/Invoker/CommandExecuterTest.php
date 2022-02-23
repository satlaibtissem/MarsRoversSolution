<?php

namespace App\Invoker;

use App\Command\Command;
use App\Command\Factory;
use App\Command\MoveForward;
use App\Data\CommandTypes;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokery;

class CommandExecuterTest extends TestCase
{
    use ModelMokery;

    /**
     * Test that CommandFactory class is an instance of Factory interface
     */
    public function testThatCommandExecuterIsAnInstanceOfInvokerInterface()
    {
        $commandExecuter = new CommandExecuter($this->getFactoryMock());
        $this->assertInstanceOf(Invoker::class, $commandExecuter);
    }

    /**
     * Test that CommandFactory class is an instance of Factory interface
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
            ->andReturn($this->getMoveForwardMock($rover));
        
        $commandExecuter = new CommandExecuter($factory);
        $commandExecuter->executeCommand(CommandTypes::MOVE_FORWARD, $rover, $plateau);
        $this->assertEquals('1 2 N', $rover->toString());
    }

    /**
     * Mock Factory interface
     */
    private function getFactoryMock(): Factory
    {
        return \Mockery::mock(Factory::class);
    }

    /**
     * @param Rover $rover
     * @return Command
     */
    private function getMoveForwardMock(Rover $rover): Command
    {
        $moveForward = \Mockery::mock(Command::class);
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

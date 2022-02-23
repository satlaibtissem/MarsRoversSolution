<?php

namespace App\Invoker;

use App\Command\Factory;
use App\Command\MoveForward;
use App\Data\CommandTypes;
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
        $this->assertInstanceOf(Invoker::class, $this->commandExecuter);
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
        $factory->shouldReceive('createCommande')
            ->with(
                CommandTypes::MOVE_FORWARD,
                [$this->getPlateau($lowerLeftCoordinate, $upperRightCoordinate)]
            )
            ->andReturn($this->getMoveForwardMock($rover));
        
        $commandExecuter = new CommandExecuter($factory);
        $commandExecuter->executeCommand($rover);
        $this->assertInstanceOf('1 2 N', $this->rover->toString());
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
     * @return Factory
     */
    private function getMoveForwardMock(Rover $rover): Factory
    {
        $moveForward = \Mockery::mock(MoveForward::class);
        $moveForward->shouldReceive('execute')
            ->with($rover)
            ->andReturnSelf();
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

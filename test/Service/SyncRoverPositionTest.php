<?php

namespace App\Invoker;

use App\Model\Plateau;
use App\Model\Rover;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokery;

class SyncRoverPositionTest extends TestCase
{
    use ModelMokery;

    /**
     * Test that CommandFactory class is an instance of Factory interface
     */
    public function testThatSyncRoverPositionIsAnInstanceOfServiceInterface()
    {
        $service = new SyncRoverPosition($this->getFactoryMock());
        $this->assertInstanceOf(Invoker::class, $service);
    }

    /**
     * Test that CommandFactory class is an instance of Factory interface
     */
    public function testThatConsumeFunctionGivesTheRightResultsForASeriesOfCommands()
    {
        $lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $rover = $this->configureRoverPosition(1, 3, 'N');
        $plateau = $this->getPlateauMock($lowerLeftCoordinate, $upperRightCoordinate);
        $commands = ['L', 'M', 'L', 'M', 'L', 'M', 'L', 'M', 'M'];
        $invoker = $this->getInvokerMock($rover, $plateau, $commands);
        
        $service = new SyncRoverPosition($invoker, $plateau);
        $service->consume($rover, $commands);
        $this->assertEquals('1 3 N', $rover->toString());
    }

    /**
     * Mock Invoker interface
     * @param Rover $rover
     * @param Plateau $plateau
     * @param array $commands
     * @return Invoker
     */
    private function getInvokerMock(Rover $rover, Plateau $plateau, array $commands): Invoker
    {
        $invoker = \Mockery::mock(Invoker::class);
        foreach ($commands as $command)
            $invoker->shouldReceive('executeCommand')
                ->with($command, $rover, $plateau)
                ->andReturnSelf();
        return $invoker;
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

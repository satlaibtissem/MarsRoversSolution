<?php
declare(strict_types=1);

namespace Test\Service;

use App\Data\CommandTypes;
use App\Data\DirectionTypes;
use App\Invoker\InvokerInterface;
use App\Model\Plateau;
use App\Model\Rover;
use App\Service\ServiceInterface;
use App\Service\SyncRoverPosition;
use PHPUnit\Framework\TestCase;
use Test\Traits\ModelMokeryTrait;

class SyncRoverPositionTest extends TestCase
{
    use ModelMokeryTrait;

    /**
     * Test that SyncRoverPosition class is an instance of Service interface
     */
    public function testThatSyncRoverPositionIsAnInstanceOfServiceInterface()
    {
        $service = new SyncRoverPosition(
            $this->getInvokerMock(),
            $this->getPlateauMock()
        );
        $this->assertInstanceOf(ServiceInterface::class, $service);
    }

    /**
     * Test that consume function gives the right results for a series of commands
     */
    public function testThatConsumeFunctionGivesTheRightResultsForASeriesOfCommands()
    {
        $lowerLeftCoordinate = $this->getCoordinateMock(0, 0);
        $upperRightCoordinate = $this->getCoordinateMock(5, 5);
        $plateau = $this->getPlateauMock($lowerLeftCoordinate, $upperRightCoordinate);
        $initialCoordinate = $this->getCoordinateMock(1, 2);
        $finalCoordinate = $this->getCoordinateMock(1, 3);
        $direction = $this->getDirectionMock(DirectionTypes::NORTH);
        $rover = $this->configureRoverMock(
            $initialCoordinate,
            $finalCoordinate,
            $direction,
            $direction
        );
        $commands = [
            CommandTypes::ROTATE_LEFT,
            CommandTypes::MOVE_FORWARD,
            CommandTypes::ROTATE_LEFT,
            CommandTypes::MOVE_FORWARD,
            CommandTypes::ROTATE_LEFT,
            CommandTypes::MOVE_FORWARD,
            CommandTypes::ROTATE_LEFT,
            CommandTypes::MOVE_FORWARD,
            CommandTypes::MOVE_FORWARD
        ];
        $invoker = $this->getInvokerMock($commands, $rover, $plateau);
        
        $service = new SyncRoverPosition($invoker, $plateau);
        $service->consume($rover, $commands);
        $this->assertEquals('1 3 N', $rover->toString());
    }

    /**
     * Mock Invoker interface
     * @param array $commands
     * @param Rover $rover
     * @param Plateau $plateau
     * @return InvokerInterface
     */
    private function getInvokerMock(array $commands = [], Rover $rover = null, Plateau $plateau = null): InvokerInterface
    {
        $invoker = \Mockery::mock(InvokerInterface::class);
        foreach ($commands as $command)
            $invoker->shouldReceive('executeCommand')
                ->with($command, $rover, $plateau)
                ->andReturnSelf();
        return $invoker;
    }
}

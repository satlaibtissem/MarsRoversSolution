<?php
declare(strict_types=1);

namespace Test\Traits;

use App\Command\CommandInterface;
use Test\Traits\ModelMokeryTrait;

trait RotatableTrait
{
    use ModelMokeryTrait;

    /**
     * Execute rotation command
     * @param CommandInterface $command
     * @param int $x
     * @param int $y
     * @param string $initialOrientation
     * @param string $finalOrientation
     */
    private function rotate(
        CommandInterface $command,
        int $x,
        int $y,
        string $initialOrientation,
        string $finalOrientation
    )
    {
        $initialDirection = $this->getDirectionMock($initialOrientation);
        $finalDirection = $this->getDirectionMock($finalOrientation);
        $this->addSetOrientationExpectationToDirectionMock(
            $initialDirection,
            $finalOrientation
        );
        $coorinate = $this->getCoordinateMock($x, $y);
        $this->rover = $this->configureRoverMock(
            $coorinate,
            $coorinate,
            $initialDirection,
            $finalDirection
        );
        $command->execute($this->rover);
    }
}
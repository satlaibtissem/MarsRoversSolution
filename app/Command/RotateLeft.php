<?php

namespace App\Command;

use App\Data\DirectionTypes;
use App\Model\Direction;
use App\Model\Rover;

class RotateLeft extends Rotatable
{
    /**
     * @inheritDoc
     */
    public function rotate(Rover $rover)
    {
        switch ($rover->getDirection()->getOrientation()) {
            case DirectionTypes::NORTH:
                $direction = DirectionTypes::WEST;
                break;
            case DirectionTypes::WEST:
                $direction = DirectionTypes::SOUTH;
                break;
            case DirectionTypes::EAST:
                $direction = DirectionTypes::NORTH;
                break;
            case DirectionTypes::SOUTH:
                $direction = DirectionTypes::EAST;
                break;
        }
        $direction = $rover->getDirection()->setOrientation($direction);
        $rover->setDirection($direction);
        return;
    }
}
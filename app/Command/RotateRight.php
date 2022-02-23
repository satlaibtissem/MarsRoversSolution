<?php

namespace App\Command;

use App\Data\DirectionTypes;
use App\Model\Rover;

class RotateRight extends Rotatable
{

    /**
     * @inheritDoc
     */
    public function rotate(Rover $rover)
    {
        switch ($rover->getDirection()->getOrientation()) {
            case DirectionTypes::NORTH:
                $direction = DirectionTypes::EAST;
                break;
            case DirectionTypes::WEST:
                $direction = DirectionTypes::NORTH;
                break;
            case DirectionTypes::EAST:
                $direction = DirectionTypes::SOUTH;
                break;
            case DirectionTypes::SOUTH:
                $direction = DirectionTypes::WEST;
                break;
        }
        $rover->getDirection()->setOrientation($direction);
        $rover->setDirection($rover->getDirection());
        return;
    }
}
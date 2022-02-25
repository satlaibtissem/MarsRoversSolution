<?php

namespace App\Command;

use App\Data\DirectionTypes;

class RotateRight extends Rotatable
{

    /**
     * @inheritDoc
     */
    protected function getDirectionAfterRotation(string $orientation): string
    {
        switch ($orientation) {
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
        return $direction;
    }
}
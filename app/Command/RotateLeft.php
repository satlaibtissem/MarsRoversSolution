<?php

namespace App\Command;

use App\Data\DirectionTypes;

class RotateLeft extends Rotatable
{
    /**
     * @inheritDoc
     */
    protected function getDirectionAfterRotation(string $orientation): string
    {
        switch ($orientation) {
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
        return $direction;
    }
}
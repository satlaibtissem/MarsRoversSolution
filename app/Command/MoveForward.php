<?php

namespace App\Command;

use App\Data\DirectionTypes;
use App\Model\Coordinate;
use App\Model\Rover;
use Exception;

class MoveForward implements Command
{
    /**
     * @var Coordinate
     */
    private $bordersCoordinate;

    /**
     * @param Coordinate $bordersCoordinate
     */
    public function __construct(Coordinate $bordersCoordinate)
    {
        $this->bordersCoordinate = $bordersCoordinate;
    }

    /**
     * @inheritDoc
     */
    public function execute(Rover $rover)
    {
        $roverCoordinate = $rover->getCoordinate();
        switch ($rover->getDirection()->getOrientation()) {
            case DirectionTypes::NORTH:
                $newYCoordinate = $rover->getCoordinate()->getY() + 1;
                if ($newYCoordinate > $this->bordersCoordinate->getY())
                    $this->throwExceptionRoverCantMove();
                $roverCoordinate->setY($newYCoordinate);
                break;
            case DirectionTypes::EAST:
                $newXCoordinate = $rover->getCoordinate()->getX() + 1;
                if ($newXCoordinate > $this->bordersCoordinate->getX())
                    $this->throwExceptionRoverCantMove();
                $roverCoordinate->setX($newXCoordinate);
                break;
            case DirectionTypes::WEST:
                $newXCoordinate = $rover->getCoordinate()->getX() - 1;
                if ($newXCoordinate < 0)
                    $this->throwExceptionRoverCantMove();
                $roverCoordinate->setX($newXCoordinate);
                break;
            case DirectionTypes::SOUTH:
                $newYCoordinate = $rover->getCoordinate()->getY() - 1;
                if ($newYCoordinate < 0)
                    $this->throwExceptionRoverCantMove();
                $roverCoordinate->setY($newYCoordinate);
                break;
        }
        $rover->setCoordinate($roverCoordinate);
        return;
    }

    /**
     * @throws Exception
     */
    private function throwExceptionRoverCantMove()
    {
        throw new Exception('Rover can\'t move');
    }
}
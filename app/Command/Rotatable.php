<?php

namespace App\Command;

use App\Model\Rover;

abstract class Rotatable implements CommandInterface
{
    /**
     * Execute rotation and return the new direction 
     * @param string $orientation
     * @return string
     */
    protected abstract function getDirectionAfterRotation(string $orientation): string;

    /**
     * @inheritDoc
     */
    public function execute(Rover $rover)
    {
        $direction = $this->getDirectionAfterRotation(
            $rover->getDirection()->getOrientation()
        );
        $rover->getDirection()->setOrientation($direction);
        $rover->setDirection($rover->getDirection());
    }
}

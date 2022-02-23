<?php

namespace App\Command;

use App\Model\Rover;

abstract class Rotatable implements Command
{
    /**
     * Rotate in a specific direction
     * @param Rover $rover
     */
    public abstract function rotate(Rover $rover);

    /**
     * @inheritDoc
     */
    public function execute(Rover $rover)
    {
        $this->rotate($rover);
    }
}

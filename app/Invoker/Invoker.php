<?php

namespace App\Invoker;

use App\Model\Plateau;
use App\Model\Rover;

interface Invoker
{
    /**
     * @param string $command
     * @param Rover $rover
     */
    public function executeCommand(string $command, Rover $rover, Plateau $plateau);
}

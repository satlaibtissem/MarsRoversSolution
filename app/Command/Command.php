<?php

namespace App\Command;

use App\Model\Rover;

interface Command
{
    /**
     * Execute command
     * @param Rover $rover
     */
    public function execute(Rover $rover);
}

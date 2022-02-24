<?php

namespace App\Command;

use App\Model\Rover;

interface CommandInterface
{
    /**
     * Execute command
     * @param Rover $rover
     */
    public function execute(Rover $rover);
}

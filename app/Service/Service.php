<?php

namespace App\Service;

use App\Model\Rover;

interface Service
{
    /**
     * Consume service
     * @param Rover $rover
     * @param array $commands
     */
    public function consume(Rover $rover, array $commands);
}

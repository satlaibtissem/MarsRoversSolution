<?php

namespace App\Service;

use App\Model\Rover;

interface ServiceInterface
{
    /**
     * Consume service
     * @param Rover $rover
     * @param array $commands
     */
    public function consume(Rover $rover, array $commands);
}

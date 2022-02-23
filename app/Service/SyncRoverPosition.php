<?php

namespace App\Service;

use App\Invoker\Invoker;
use App\Model\Plateau;
use App\Model\Rover;

class SyncRoverPosition implements Service
{
    /**
     * @var Plateau
     */
    private $plateau;
    /**
     * @var Invoker
     */
    private $invoker;

    /**
     * @param Invoker $invoker
     * @param Plateau $plateau
     */
    public function __construct(Invoker $invoker, Plateau $plateau)
    {
        $this->invoker = $invoker;
        $this->plateau = $plateau;
    }

    /**
     * @inheritDoc
     */
    public function consume(Rover $rover, array $commands)
    {
        foreach ($commands as $command)
        {
            $this->invoker->executeCommand($command, $rover, $this->plateau);
        }
    }
}

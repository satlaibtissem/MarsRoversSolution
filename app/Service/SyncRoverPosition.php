<?php

namespace App\Service;

use App\Invoker\InvokerInterface;
use App\Model\Plateau;
use App\Model\Rover;

class SyncRoverPosition implements ServiceInterface
{
    /**
     * @var Plateau
     */
    private $plateau;
    /**
     * @var InvokerInterface
     */
    private $invoker;

    /**
     * @param InvokerInterface $invoker
     * @param Plateau $plateau
     */
    public function __construct(InvokerInterface $invoker, Plateau $plateau)
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

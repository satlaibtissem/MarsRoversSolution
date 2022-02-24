<?php

namespace App\Invoker;

use App\Command\FactoryInterface;
use App\Model\Plateau;
use App\Model\Rover;

class CommandExecuter implements InvokerInterface
{
    /**
     * @var FactoryInterface
     */
    private $commandFactory;

    /**
     * @param FactoryInterface $commandFactory
     */
    public function __construct(FactoryInterface $commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }

    /**
     * @inheritDoc
     */
    public function executeCommand(string $command, Rover $rover, Plateau $plateau)
    {
        $command = $this->commandFactory->createCommand($command, [
            'plateau' => $plateau
        ]);
        $command->execute($rover);
    }
}

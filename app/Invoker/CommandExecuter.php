<?php

namespace App\Invoker;

use App\Command\Factory;
use App\Model\Plateau;
use App\Model\Rover;

class CommandExecuter implements Invoker
{
    /**
     * @var Factory
     */
    private $commandFactory;

    /**
     * @param Factory $commandFactory
     */
    public function __construct(Factory $commandFactory)
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

<?php

namespace App\Command;


interface FactoryInterface
{
    /**
     * Create a command based on a commad type
     * @param string $commandType
     * @param array $args
     * @return CommandInterface
     */
    public function createCommand(string $commandType, array $args = []): CommandInterface;
}
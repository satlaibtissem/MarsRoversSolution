<?php

namespace App\Command;


interface Factory
{
    /**
     * Create a command based on a commad type
     * @param string $commandType
     * @param array $args
     * @return Command
     */
    public function createCommand(string $commandType, array $args = []): Command;
}
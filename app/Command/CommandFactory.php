<?php

namespace App\Command;

use App\Data\CommandTypes;

class CommandFactory implements Factory
{
    /**
     * @inheritDoc
     */
    public function createCommand(string $commandType, array $args = []): Command
    {
        switch ($commandType) {
            case CommandTypes::MOVE_FORWARD:
                if (count($args) === 0)
                    throw new \Exception('Invalid arguments for command type ' . $commandType);
                return new MoveForward(...$args);
            case CommandTypes::ROTATE_LEFT:
                return new RotateLeft();
            case CommandTypes::ROTATE_RIGHT:
                return new RotateRight();
            default:
                throw new \Exception('Invalid Command Type ' . $commandType);
        }
    }
}
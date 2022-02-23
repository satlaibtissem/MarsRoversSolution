<?php

use App\Command\CommandFactory;
use App\Command\Factory;
use App\Invoker\CommandExecuter;
use App\Invoker\Invoker;
use App\Service\Service;
use App\Service\SyncRoverPosition;

return [
    Invoker::class => DI\autowire(CommandExecuter::class),
    Factory::class => DI\autowire(CommandFactory::class),
    Service::class => DI\autowire(SyncRoverPosition::class)
  ];
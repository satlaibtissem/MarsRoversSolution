<?php

use App\Command\CommandFactory;
use App\Command\FactoryInterface;
use App\Invoker\CommandExecuter;
use App\Invoker\InvokerInterface;
use App\Service\ServiceInterface;
use App\Service\SyncRoverPosition;

return [
    InvokerInterface::class => DI\autowire(CommandExecuter::class),
    FactoryInterface::class => DI\autowire(CommandFactory::class),
    ServiceInterface::class => DI\autowire(SyncRoverPosition::class)
  ];
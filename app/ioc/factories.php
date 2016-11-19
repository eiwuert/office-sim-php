<?php

use Simulation\Factories\MarketingFactory;
use Simulation\Services\Queue;
use Simulation\Services\Processor;
use Simulation\Services\Logger;
use Simulation\Helpers\SimulationHelpers;
use Simulation\Contracts\MarketingServiceRepository;

$factories = array();

$factories[MarketingFactory::class] = DI\object()
    ->constructor(
     	DI\get(MarketingServiceRepository::class),
     	DI\get(SimulationHelpers::class),
     	DI\get(Queue::class),
     	DI\get(Logger::class)
    );

return $factories;
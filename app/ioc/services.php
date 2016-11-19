<?php

use Simulation\Services\Simulation;
use Simulation\Services\Timer;
use Simulation\Services\Logger;
use Simulation\Services\Queue;
use Simulation\Services\Statistics;

use Simulation\Factories\MarketingFactory;

use Simulation\Contracts\Model;

$services = array();

//define a timer
$services[Timer::class] = DI\object();

//define a queue
$services[Queue::class] = DI\object()->constructor(
        DI\get(Logger::class)
    );


//define a logger
$services[Logger::class] = DI\object()->constructor(
		DI\get(Timer::class)
	);

//define statistics
$services[Statistics::class] = DI\object()->constructor(
		DI\get(Logger::class)
	);

$services[Simulation::class] = DI\object()
	->constructor(
		DI\get('simulation.config'),
		DI\get(Timer::class),  
        DI\get(Queue::class),
        DI\get(MarketingFactory::class)
	);

return $services;
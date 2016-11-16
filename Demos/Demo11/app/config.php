<?php

use Simulation\Controller\SimulateController;
use Simulation\Services\SimulationService;
use Simulation\Services\Timer;
use Simulation\Services\Logger;

$config = array();

$config['simulation.config'] = require __DIR__ . '/../src/Simulation/Data/simulation.php';

//define a timer
$config[Timer::class] = DI\object(Timer::class);

//define a logger
$config[Logger::class] = DI\object(Logger::class);

$config[SimulateController::class] = DI\object()
    	->constructor(DI\get(SimulationService::class));

$config[SimulationService::class] = DI\object()
    	->constructor(DI\get(Timer::class), DI\get('simulation.config'));

return $config;
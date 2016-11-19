<?php

use Simulation\Controller\HomeController;
use Simulation\Controller\SimulateController;

use Simulation\Services\Simulation;
use Simulation\Services\Statistics;

$controllers = array();

//controllers
$controllers[HomeController::class] = DI\object()
    ->constructor(
        DI\get(Twig_Environment::class)
    );

$controllers[SimulateController::class] = DI\object()
        ->constructor(
            DI\get(Simulation::class),
            DI\get(Statistics::class)
        );

return $controllers;
<?php

use Simulation\Controller\HomeController;
use Simulation\Controller\SimulateController;
use Simulation\Services\SimulationService;
use Simulation\Services\Timer;
use Simulation\Services\Logger;
use Simulation\Services\Queue;
use Simulation\Services\Statistics;

use Simulation\Contracts\MarketingServiceRepository;
use Simulation\Repositories\InMemoryMarketingServiceRepository;

use Simulation\Helpers\SimulationHelpers;

use Simulation\Services\MarketingService;
use Simulation\Services\MarketingServiceSimulator;

use Simulation\Contracts\EntityRepository;
use Simulation\Repositories\InMemoryEntityRepository;


use Simulation\Services\SalesService;
use Simulation\Services\SalesServiceSimulator;


$config = array();

$config[Twig_Environment::class] = function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../src/Simulation/Views');
        return new Twig_Environment($loader);
};

$config[SimulationHelpers::class] = DI\object();


//entity repo
$config[EntityRepository::class] = DI\object(InMemoryEntityRepository::class);


//map marketing repository to marketing repository interface
$config[MarketingServiceRepository::class] = DI\object(InMemoryMarketingServiceRepository::class);
$config[MarketingServiceSimulator::class] = DI\object()
    ->constructor( 
        DI\get( Logger::class ),
        DI\get( SimulationHelpers::class ),
        DI\get( Queue::class ),
        DI\get( EntityRepository::class )
    );

//marketing service
$config[MarketingService::class] = DI\object()
    ->constructor( 
        DI\get( MarketingServiceRepository::class ),
        DI\get( MarketingServiceSimulator::class ) 
    );


$config[SalesServiceSimulator::class] = DI\object()
    ->constructor( 
        DI\get( Logger::class ),
        DI\get( SimulationHelpers::class ),
        DI\get( Queue::class ),
        DI\get( EntityRepository::class )
    );
    
//sales service
$config[SalesService::class] = DI\object()
    ->constructor( 
        DI\get( EntityRepository::class ),
        DI\get( SalesServiceSimulator::class ) 
    );

//simulation config data
$config['simulation.config'] = require __DIR__ . '/../src/Simulation/Data/simulation.php';

//define a timer
$config[Timer::class] = DI\object();

//define a queue
$config[Queue::class] = DI\object()->constructor(
        DI\get(Logger::class)
    );

//define a logger
$config[Logger::class] = DI\object()->constructor(
		DI\get(Timer::class)
	);

//define statistics
$config[Statistics::class] = DI\object()->constructor(
		DI\get(Logger::class)
	);

//controllers
$config[HomeController::class] = DI\object()
    ->constructor(
        DI\get(Twig_Environment::class)
    );

$config[SimulateController::class] = DI\object()
    	->constructor(
    		DI\get(SimulationService::class),
    		DI\get(Statistics::class)
    	);

//services
$config[SimulationService::class] = DI\object()
    	->constructor(
    		DI\get(Timer::class), 
    		DI\get('simulation.config'), 
    		DI\get(MarketingService::class),
            DI\get(SalesService::class),
            DI\get( Queue::class )
    	);

return $config;
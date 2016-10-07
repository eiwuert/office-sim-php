<?php

require_once __DIR__ . '/../../vendor/autoload.php';

require_once(__DIR__ . '/includes/controllers.inc');

require_once(__DIR__ . '/includes/helpers.inc');
require_once(__DIR__ . '/includes/log_services.inc');

require_once(__DIR__ . '/includes/backlog_service.inc');
require_once(__DIR__ . '/includes/office_services.inc');
require_once(__DIR__ . '/includes/time_services.inc');
require_once(__DIR__ . '/includes/simulation_service.inc');
require_once(__DIR__ . '/includes/processors.inc');
require_once(__DIR__ . '/includes/department_services.inc');

require_once(__DIR__ . '/includes/service_simulation.inc');
//require_once(__DIR__ . '/includes/service_simulation_statistics.inc');

require_once(__DIR__ . '/includes/marketing_services.inc');
require_once(__DIR__ . '/includes/marketing_simulation.inc');

use Pimple\Container;

$container = new Container();

echo '<pre>';
print_r($container);
echo '</pre>';
die();
$container['helpers'] = function ($c) 
{ 
	return new Helpers\Helpers(); 
};

$container['timer'] = function ($c) 
{ 
	return new Timer(); 
};

$container['logger'] = function ($c) 
{ 
	return new Logger($c['timer']); 
};

$container['backlog'] = function ($c) 
{ 
	return new Backlog(); 
};

$container['marketing'] = function ($c) 
{ 
	$marketingData = json_decode(file_get_contents(__DIR__ . '/data/marketing.json'),true);
	return new MarketingServices\MarketingServices($marketingData);
};

$container['office'] = function ($c) 
{ 
	return new Office(); 
};

$container['simulation'] = function ($c) 
{ 
	$simulationData = json_decode(file_get_contents(__DIR__ . '/data/simulation.json'),true);
	return new SimulationService\Simulation($c['logger'],$c['backlog'],$c['office'],$c['timer'],$simulationData); 
};

$container['marketing_simulation'] = function ($c) 
{ 
	return new MarketingSimulation($c['helpers'],$c['logger'],$c['backlog']); 
};



$officeServices = $container['office'];
$officeServices->addService($container['marketing']);

$simulation = $container['simulation'];
$simulation->runSimulation();






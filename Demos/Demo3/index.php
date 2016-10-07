<?php

require_once(__DIR__ . '/includes/pimple.inc');
require_once(__DIR__ . '/includes/logger.inc');
require_once(__DIR__ . '/includes/timer.inc');
require_once(__DIR__ . '/includes/backlog.inc');
require_once(__DIR__ . '/includes/helpers.inc');
require_once(__DIR__ . '/includes/office.inc');

//require_once(__DIR__ . '/includes/office/departments/department.inc');
//require_once(__DIR__ . '/includes/office/departments/simulation.inc');

require_once(__DIR__ . '/includes/office/departments/marketing/marketing_test.inc');
//require_once(__DIR__ . '/includes/office/departments/marketing/simulation.inc');

require_once(__DIR__ . '/includes/simulation.inc');

$container = new Pimple();

$container['logger_class'] 			= 'StdLogger';
$container['timer_class'] 			= 'StdTimer';
$container['helper_class'] 			= 'StdHelpers';
$container['backlog_class'] 		= 'StdBacklog';
$container['office_class'] 			= 'StdOffice';

$container['marketing_data'] 		= json_decode(file_get_contents(__DIR__ . '/data/marketing.json'),true);

foreach($container['marketing_data']['services'] AS $key => $service)
{	

	$simClassName = $service['simulation']['classes']['simulationClass']['value'];


	echo '<pre>';
	print_r($service);
	echo '</pre>';
	die();

}

die();
$container['marketing_class'] 		= 'Marketing';

$container['simulation_data'] 		= json_decode(file_get_contents(__DIR__ . '/data/simulation.json'),true);
$container['simulation_class'] 		= 'Simulation';

$container['timer'] = $container->share(function ($c) 
{
    return new $c['timer_class']();
});

$container['helpers'] = $container->share(function ($c) 
{
    return new $c['helper_class']();
});

$container['backlog'] = $container->share(function ($c) 
{
    return new $c['backlog_class']();
});

$container['logger'] = $container->share(function ($c) 
{
    return new $c['logger_class']($c['timer']);
});

$container['marketing'] = function ($c) 
{ 
	return new $c['marketing_class']($c['marketing_data']);
};

$container['office'] = $container->share(function ($c) 
{
    return new $c['office_class']($c['backlog']);
});

$office = $container['office'];
$office->addService($container['marketing']);

$container['simulation'] = function ($c) {
    return new $c['simulation_class']($c['timer'], $c['office'], $c['simulation_data']);
};

$simulation = $container['simulation'];
$simulation->runSimulation();

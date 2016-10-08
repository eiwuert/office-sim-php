<?php

require_once(__DIR__ . '/includes/pimple.inc');

require_once(__DIR__ . '/includes/processor.inc');

require_once(__DIR__ . '/includes/simulation.inc');

require_once(__DIR__ . '/includes/service.inc');
require_once(__DIR__ . '/includes/services.inc');
require_once(__DIR__ . '/includes/marketing.inc');


$marketingData = json_decode(file_get_contents(__DIR__ . '/data/marketing.json'),true);


/* register all process classes */
$processContainer = new Pimple();
foreach($marketingData['services'] AS $key => $data)
{	
	if(!$data['active'])
		continue;

	$processClass = $data['simulation']['classes']['processClass']['value'];
	$processClassName = 'process_' . strtolower($processClass);

	$processContainer[$processClassName] = function ($c) use ($processClass)
	{
	    return new $processClass();
	};

}

/* register all simulation classes */
$simulationContainer = new Pimple();
foreach($marketingData['services'] AS $key => $data)
{	
	if(!$data['active'])
		continue;

	$simClass = $data['simulation']['classes']['simulationClass']['value'];
	$simClassName = 'simulation_' . strtolower($simClass);

	$processClass = $data['simulation']['classes']['processClass']['value'];
	$processClassName = 'process_' . strtolower($processClass);

	$processor = $processContainer[$processClassName];
	
	$simulationContainer[$simClassName] = function ($c) use ($simClass,$processor)
	{
	    return new $simClass($processor);
	};
}

$marketingServices = new DepartmentServices();

foreach($marketingData['services'] AS $key => $data)
{	
	if(!$data['active'])
		continue;

	$simClass = $data['simulation']['classes']['simulationClass']['value'];
	$simClassName = 'simulation_' . strtolower($simClass);

	$service = new DepartmentService($data, $simulationContainer[$simClassName]);
	$marketingServices->addService($service);	
}

$marketing = new Marketing($marketingServices);

$marketing->runDepartmentServices();




<?php

require __DIR__ . '/../vendor/autoload.php';

use FreshJones\Office\Services\Services\Office;
use FreshJones\Office\Services\Services\SimulationServiceFactory;

use Freshjones\Core\Helpers\SimulationHelpers;

use FreshJones\Office\Services\Services\SimulationServiceInputFactory;
use FreshJones\Office\Services\Services\SimulationServiceOutputFactory;
use FreshJones\Office\Services\Simulations\BaseSimulatorFactory;

use FreshJones\Office\Services\Simulations\BaseOpportunityConverterFactory;
use FreshJones\Office\Services\Simulations\MonthlyDelayerFactory;

$serviceFactory 				= new SimulationServiceFactory();

$helpers 						= new SimulationHelpers();
$serviceInputFactory 			= new SimulationServiceInputFactory();

$serviceOutputFactory 			= new SimulationServiceOutputFactory();

$baseSimulatorFactory 			= new BaseSimulatorFactory();
$delayerFactory 				= new MonthlyDelayerFactory($helpers);

$opportunityConverterFactory 	= new BaseOpportunityConverterFactory($helpers);

$marketingData = require 'data/marketing.php';

$services = array();

if(isset($marketingData['services']))
{
	
	foreach($marketingData['services'] AS $serviceKey => $serviceData)
	{	

		if(!$serviceData['active'])
			continue;

		$service = $serviceFactory->make();
		$service->setParam('Name', $serviceData['name'] );
		$service->setParam('Department', $serviceData['department'] );
		$service->setParam('Inputs', $serviceInputFactory->make() );
		$service->setParam('Delays',0);

		$inputs = array();

		foreach($serviceData['inputs'] AS $input)
		{
			$inputs[] = $serviceInputFactory->make();
		}
		
		$service->setParam('Inputs', $inputs );

		$outputs = array();

		foreach($serviceData['outputs'] AS $output)
		{
			$outputs[] = $serviceOutputFactory->make();
		}
		
		$service->setParam('Outputs', $outputs );

		$simData = $serviceData['simulation'];

		$opportunityConverter = $opportunityConverterFactory->make();
		$opportunityConverter->setOpportunities($simData['opportunities']);
		$opportunityConverter->setProbability($simData['probability']);

		$simulator = $baseSimulatorFactory->make();
		$simulator->setOpportunityConverter( $opportunityConverter );

		$delayer = $delayerFactory->make();

		$delayer->setProcessDelays($simData['processtime']);
		
		if(isset($simData['startdelays']))
			$delayer->setStartDelays($simData['startdelays']);

		if(isset($simData['finishdelays']))
			$delayer->setFinishDelays($simData['finishdelays']);

		$simulator->setProcessDelayer( $delayer );

		$service->setParam('Simulator', $simulator );

		$services[] = $service;

	}

}

$departments = array();
$departments['marketing'] = $services;

$office = new Office($departments);

return $office;
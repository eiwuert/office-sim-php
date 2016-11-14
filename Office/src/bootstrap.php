<?php

require __DIR__ . '/../vendor/autoload.php';

use Freshjones\Core\Helpers\SimulationHelpers;
use FreshJones\Office\Services\Services\Office;

//use Freshjones\Core\Helpers\Container;

//use FreshJones\Office\Services\Departments\Department;
//use FreshJones\Office\Services\Departments\Marketing;
//use FreshJones\Office\Services\Departments\Sales;
//use FreshJones\Office\Services\Departments\Customer;


use FreshJones\Office\Services\Services\ServiceOutputFactory;
use FreshJones\Office\Services\Simulations\BaseSimulatorFactory;
use FreshJones\Office\Services\Simulations\DelayFactory;

//$marketing = new Marketing('marketing');
//$marketing->setServices( new ServiceContainer(require 'data/marketing.php') );

//$sales = new Sales('sales');
//$sales->setServices( new ServiceContainer(require 'data/sales.php') );

//$customer = new Customer('customer');
//$customer->setServices( new ServiceContainer(require 'data/customer.php') );

//$departments = new Container();
//$departments->set( );
//$departments->set('sales', $sales);
//$departments->set('customer', $customer);

//$office = new OfficeContainer();
//$office->setDepartment('marketing', require 'data/marketing.php' );
//$office->setDepartment('sales', require 'data/sales.php' );

//$helpers = new SimulationHelpers();

$serviceOutputFactory 	= new ServiceOutputFactory();
$baseSimulatorFactory 	= new BaseSimulatorFactory();
$delayFactory 			= new DelayFactory();
$helpers 				= new SimulationHelpers();

$marketingData = require 'data/marketing.php';

$services = array();

if(isset($marketingData['services']))
{
	
	foreach($marketingData['services'] AS $serviceKey => $serviceData)
	{	

		if(!$serviceData['active'])
			continue;

		$services[$serviceKey] = array();
		$services[$serviceKey]['name'] = $serviceData['name'];
		$services[$serviceKey]['department'] = $serviceData['department'];

		$outputs = array();
		foreach($serviceData['outputs'] AS $outputName => $outputData)
		{
			//placeholder replace this with actual service output objects
			$outputs[$outputName] = $serviceOutputFactory->make();
		}

		$services[$serviceKey]['outputs'] = $outputs;
		
		unset($serviceData['simulation']['classes']);

		$startdelays = array();
		if( isset($serviceData['simulation']['startdelays']) )
		{
			$startdelays = $serviceData['simulation']['startdelays'];
			unset($serviceData['simulation']['startdelays']);
		}

		$finishdelays = array();
		if( isset($serviceData['simulation']['finishdelays']) )
		{
			$finishdelays = $serviceData['simulation']['finishdelays'];
			unset($serviceData['simulation']['finishdelays']);
		}

		$simulator = $baseSimulatorFactory->make($serviceData['simulation']);
		$simulator->setDelay('start', $delayFactory->make( $startdelays ) );
		$simulator->setDelay('finish', $delayFactory->make( $finishdelays ) );
	
		$services[$serviceKey]['simulator'] = $simulator;
		
	}

}

$departments = array();
$departments['marketing'] = $services;

$office = new Office($departments);

return $office;
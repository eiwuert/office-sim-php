<?php

use App\Departments\Marketing\Includes\Marketing;
use App\Departments\Marketing\Includes\MarketingService;
use App\Departments\Marketing\Includes\MarketingServiceSimulation;

use App\Departments\Services\Services;
use App\Includes\JsonData;

$marketingDataFiles = array();
$marketingDataFiles['services'] = array('dir' => __DIR__ . '/data/', 'name' => 'services.json');
$marketingDataFiles['settings'] = array('dir' => __DIR__ . '/data/', 'name' => 'settings.json');

$marketingData = new JsonData($marketingDataFiles);

$marketingServices = new Services();

foreach($marketingData->getData('services') AS $serviceData)
{
	if(!$serviceData['active'])
		continue;

	$marketingService = new MarketingService($serviceData, new MarketingServiceSimulation() );
	$marketingServices->setService($marketingService);
}

$marketing = new Marketing($marketingServices);


<?php

require_once(__DIR__ . '/includes/pimple.inc');
require_once(__DIR__ . '/includes/service.inc');
require_once(__DIR__ . '/includes/services.inc');
require_once(__DIR__ . '/includes/marketing.inc');


$marketingData = json_decode(file_get_contents(__DIR__ . '/data/marketing.json'),true);

//$container = new Pimple();

//$container['marketing_class'] = 'Marketing';
//$container['marketing_data'] = $marketingData;

/* we need to get all simulation classes registered */
foreach($marketingData['services'] AS $key => $data)
{	


}

$marketingServices = new DepartmentServices();

foreach($marketingData['services'] AS $key => $data)
{	
	if(!$data['active'])
		continue;
	
	$service = new DepartmentService($data);

	$marketingServices->addService($service);	
}

$marketing = new Marketing($marketingServices);

$marketing->runDepartmentServices();




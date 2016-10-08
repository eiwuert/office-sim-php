<?php

require_once(__DIR__ . '/includes/pimple.inc');
require_once(__DIR__ . '/includes/container.inc');
require_once(__DIR__ . '/includes/backlog.inc');
require_once(__DIR__ . '/includes/helpers.inc');
require_once(__DIR__ . '/includes/timer.inc');
require_once(__DIR__ . '/includes/logger.inc');

require_once(__DIR__ . '/includes/simulations/simulation.inc');

$helpers = new Helpers();
$timer = new Timer();
$logger = new Logger($timer);

$marketingData = json_decode(file_get_contents(__DIR__ . '/data/marketing.json'),true);

$simulations = new Container();

foreach($marketingData['services'] AS $key => $data)
{	
	if(!$data['active'])
		continue;

	$simClassName = $data['simulation']['class']['value'];
	$simulations->set($simClassName, new $simClassName($data,$helpers,$logger));
}

$marSim = $simulations->get('MarketingServiceSimulation');

echo '<pre>';
print_r($marSim->simulate());
echo '</pre>';
die();
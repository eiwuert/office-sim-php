<?php

require_once(__DIR__ . '/includes/helpers.inc');
require_once(__DIR__ . '/includes/process_service.inc');
require_once(__DIR__ . '/includes/office_services.inc');
require_once(__DIR__ . '/includes/time_services.inc');
require_once(__DIR__ . '/includes/simulation_service.inc');
require_once(__DIR__ . '/includes/simulation.inc');
require_once(__DIR__ . '/includes/processors.inc');
require_once(__DIR__ . '/includes/department_services.inc');
require_once(__DIR__ . '/includes/marketing_services.inc');
require_once(__DIR__ . '/includes/marketing_simulation.inc');

/* data */
$simulationData = json_decode(file_get_contents(__DIR__ . '/data/simulation.json'),true);
$marketingData = json_decode(file_get_contents(__DIR__ . '/data/marketing.json'),true);

/* bootstrap */
$timeServices = new TimeServices\TimeServices();
$processService = new ProcessServices\ProcessService();
$officeServices = new OfficeServices\OfficeServices();

$marketingServices = new MarketingServices\MarketingServices($processService,$marketingData);
$officeServices->addService($marketingServices);

$simulationServices = new SimulationService\Simulation($simulationData, $timeServices, $processService, $officeServices);
$simulationServices->runSimulation();




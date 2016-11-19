<?php

$data = array();

$simulation = require __DIR__ . '/../../src/Simulation/Data/simulation.php';
$data['simulation.config'] = $simulation;

$marketing = require __DIR__ . '/../../src/Simulation/Data/marketing.php';
$data['marketing.config'] = $marketing;

//simulation config data
//$data['simulation.config'] = require __DIR__ . '/../../src/Simulation/Data/simulation.php';

return $data;
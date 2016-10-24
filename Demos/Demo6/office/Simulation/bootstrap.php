<?php

namespace App\Includes\Simulation;

use \App\Includes\JsonData;
use App\Simulation\Includes\Timer;
use App\Simulation\Includes\Simulation;

$simulation = new Simulation (
		new Timer(),
		new JsonData(
			array(
				'settings' => array('dir' => __DIR__ . '/data/', 'name' => 'simulation.json')
			)
		)
	);
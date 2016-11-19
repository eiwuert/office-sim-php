<?php

use Simulation\Helpers\SimulationHelpers;

$helpers = array();

$helpers[SimulationHelpers::class] = DI\object();

return $helpers;
<?php

namespace App\Contracts\Simulation;

use App\Contracts\Office\OfficeInterface;

interface SimulationInterface
{
	public function run(OfficeInterface $office);
}

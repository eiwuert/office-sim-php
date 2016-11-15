<?php

namespace FreshJones\Office\Services\Services;

use FreshJones\Office\Contracts\ServiceFactoryContract;

class SimulationServiceFactory implements ServiceFactoryContract
{

	public function make()
	{
		return new SimulationService();
	}

}
<?php

namespace FreshJones\Office\Services\Services;

use FreshJones\Office\Contracts\ServiceInputFactoryContract;

class SimulationServiceInputFactory implements ServiceInputFactoryContract
{

	public function __construct()
	{
		
		
		
	}

	public function make()
	{
		return new SimulationServiceInput();
	}

}
<?php

namespace FreshJones\Office\Services\Services;

use FreshJones\Office\Contracts\ServiceOutputFactoryContract;

class SimulationServiceOutputFactory implements ServiceOutputFactoryContract
{

	public function __construct()
	{
		
		
		
	}

	public function make()
	{
		return new SimulationServiceOutput();
	}

}
<?php

namespace FreshJones\Office\Services\Services;

use Freshjones\Core\Helpers\Container;
use FreshJones\Office\Services\Simulations\SimulatorInterface;
use \App\Services\Simulation;

interface ServiceInterface 
{
	public function simulate(Simulation $simulation);
}

abstract class Service extends Container implements ServiceInterface
{

	public function __construct(array $config=array(), SimulatorInterface $simulator)
	{
	
		foreach($config AS $key => $value)
		{
			$this->set($key, $value);
		}

		$this->set('simulator', $simulator);
	
	}

	public function simulate(Simulation $simulation)
	{

		$this->get('simulator')->run($this,$simulation);
	}

}

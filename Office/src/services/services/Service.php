<?php

namespace FreshJones\Office\Services\Services;

use Freshjones\Core\Helpers\Container;
use FreshJones\Office\Services\Simulations\ServiceSimulatorInterface;
use \App\Services\Simulation;

interface ServiceInterface 
{
	public function simulate(Simulation $simulation);
}

abstract class Service extends Container implements ServiceInterface
{

	public function __construct(array $config=array())
	{
		foreach($config AS $key => $value)
		{
			$this->set($key, $value);
		}
	}

	public function setSimulator(ServiceSimulatorInterface $simulator)
	{
		$this->set('simulator', $simulator);
	}

	public function setOutputs(ServiceOutputContainer $outputs)
	{
		$this->set('outputs', $outputs);
	}

	public function simulate(Simulation $simulation)
	{
		$this->get('simulator')->run($this,$simulation);
	}

}

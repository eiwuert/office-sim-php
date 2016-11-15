<?php

namespace FreshJones\Office\Services\Services;

use FreshJones\Office\Contracts\ServiceContract;
use \App\Services\Simulation;


/* the goal of a service is to convert its inputs into outputs by running its processes */

class SimulationService implements ServiceContract
{
	private $parameters;

	public function __construct(){}

	public function setParam($name,$value)
	{
		$this->parameters[$name] = $value;
	}

	public function getParam($name='all')
	{
		if($name === 'all')
			return $this->parameters;

		return isset($this->parameters[$name]) ? $this->parameters[$name] : false;
	}

	//returns service instances
	public function start()
	{
		return $this->getParam('Simulator')->getInstances($this);
	}

	// runs output objects
	public function finish()
	{

		foreach($this->getParam('Outputs') AS $output)
		{
			$output->run();
		}

	}

	function __clone()
	{
    	$this->setParam('Simulator', clone $this->getParam('Simulator'));
    } 

}

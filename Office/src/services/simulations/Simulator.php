<?php

namespace FreshJones\Office\Services\Simulations;

//use Freshjones\Core\Helpers\Container;
use Freshjones\Core\Helpers\SimulationHelpers;
use FreshJones\Office\Services\Services\ServiceInterface;
use App\Services\Simulation;

interface SimulatorInterface 
{
	
	public function run(ServiceInterface $service,Simulation $simulation);

}

abstract class Simulator implements SimulatorInterface
{
	protected $config;
	protected $helpers;
	protected $outputs;

	protected $service;
	protected $simulation;

	public function __construct( array $config=array() )
	{
		$this->config = $config;
		$this->helpers = new SimulationHelpers();
	}

	public function getService()
	{
		return $this->service;
	}

	public function getSimulation()
	{
		return $this->simulation;
	}

	public function getOutputCount()
	{
		return $this->outputs;
	}

	public function getHelpers()
	{
		return $this->helpers;
	}

	public function getConfigValue($value)
	{	
		if( isset($this->config[$value]) )
		{
			return isset($this->config[$value]['value']) ? $this->config[$value]['value'] : $this->config[$value];
		}
		
		return false;

	}

	abstract function run(ServiceInterface $service,Simulation $simulation);

}
<?php

namespace FreshJones\Office\Services\Simulations;

//use Freshjones\Core\Helpers\Container;
use Freshjones\Core\Helpers\SimulationHelpers;
use FreshJones\Office\Services\Services\ServiceInterface;
use App\Services\Simulation;

interface ServiceSimulatorInterface 
{
	public function run(ServiceInterface $service,Simulation $simulation);
}

abstract class Simulator implements ServiceSimulatorInterface
{
	
	protected $config;
	protected $helpers;
	protected $delays;

	protected $logger;
	
	//protected $service;
	//protected $simulation;
	
	public function __construct( array $config=array() )
	{
		$this->initialize($config);
	}

	private function initialize($config)
	{
		$this->setConfig($config);
		$this->setHelpers();
		$this->setDelays();
	}

	private function setConfig($config)
	{
		$this->config = $config;
	}

	private function setHelpers()
	{
		$this->helpers = new SimulationHelpers();
	}

	private function setDelays()
	{

		$delays = array();

		$delays['start'] = array();
		$delays['finish'] = array();

		$this->delays = $delays;
		
	}

	public function getConfigValue($value='all')
	{	

		if($value==='all')
		{
			return $this->config;
		}

		if( isset($this->config[$value]) )
		{
			return isset($this->config[$value]['value']) ? $this->config[$value]['value'] : $this->config[$value];
		}
		
		return false;

	}

	public function getHelpers()
	{
		return $this->helpers;
	}

	public function getDelays()
	{
		return $this->delays;
	}


	abstract function run(ServiceInterface $service,Simulation $simulation);


	
	/*
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
		return $this->outputcount;
	}

	public function getHelpers()
	{
		return $this->helpers;
	}
	*/

}
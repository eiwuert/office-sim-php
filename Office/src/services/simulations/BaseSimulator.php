<?php

namespace FreshJones\Office\Services\Simulations;

use FreshJones\Office\Contracts\ServiceContract;
use \App\Services\Timer;
use \App\Services\Logger;

class BaseSimulator
{
	private $name;
	private $department;
	private $logger;
	private $timer;
	private $config;
	private $parameters;
	private $opportunityConverter;
	private $delayer;
	private $delayCount=0;

	public function __construct() {}

	public function setOpportunityConverter(OpportunityConverterInterface $opportunityConverter)
	{
		$this->opportunityConverter = $opportunityConverter;
	}

	public function setProcessDelayer(DelayerInterface $delayer)
	{
		$this->delayer = $delayer;
	}

	//gets output count from opportunity settings
	private function generateOutput()
	{
		return $this->opportunityConverter->convert($this->department,$this->name,$this->logger);
	}
	
	public function getDelayCount()
	{
		return $this->delayCount;
	}

	//returns a number of service instances 
	public function getInstances(ServiceContract $service)
	{

		$this->name 		= $service->getParam('Name');
		$this->department 	= $service->getParam('Department');
		
		//generate a number of outputs
		$count = $this->generateOutput();

		if(!$count)
			return false;

		$instances = array();

		for($i=0; $i<$count; $i++)
		{
			$instances[] = $service;	
		}

		return !empty($instances) ? $instances : false;

	}

	public function setLogger(Logger $logger)
	{
		$this->logger = $logger;
	}

	public function start()
	{
		return $this->delayer->delayStart($this->department,$this->name,$this->logger);	
	}

	public function delay()
	{
		$delay = $this->delayer->delayFinish($this->department,$this->name,$this->logger);

		if(!$delay)
			return false;

		$this->delayCount += 1;

		return $delay;
	}

}
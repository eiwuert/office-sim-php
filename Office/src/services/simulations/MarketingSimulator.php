<?php

namespace FreshJones\Office\Services\Simulations;


use Freshjones\Core\Helpers\Container;
use FreshJones\Office\Services\Services\ServiceInterface;
use \App\Services\Simulation;


class MarketingSimulator extends Simulator
{
	
	/*
		the job of a simulator is to simulate a service
		a services job is to convert its inputs into outputs
		so a simulators job is to log statistics about how the service performed
		and return the outputs the service would have produced
	*/
	public function run(ServiceInterface $service,Simulation $simulation)
	{

		$this->service 		= $service;
		$this->simulation 	= $simulation;

		$this->setOutputs();

		$this->populateQueue();

	}

	private function populateQueue()
	{

		if(!$this->outputs)
			return;

		$processor = $this->simulation->getQueueProcessor('marketing');

		echo '<pre>';
		print_r($processor);
		echo '</pre>';
		die();

	}

	private function setOutputs()
	{

		$this->outputs = 0;

		$logger = $this->simulation->getLogger();
		$service = $this->service->get('name');
		$department = $this->service->get('department');

		$count = $this->helpers->getRandomMinMaxValue($this->config['opportunities']);

		if(!$count)
			return $logger;

		$logger->addRecord($department, $service, 'Attempted', $count);

		for($i=0; $i<$count; $i++)
		{

			if
			(
				!$this->helpers->getRandomProbability
				( 
					$this->getConfigValue('probability') 
				) 
			)
			{
				$logger->addRecord($department, $service, 'Missed', 1);
			} 
			else 
			{
				$this->outputs += 1;
				$logger->addRecord($department, $service, 'Converted', 1);
			}

		}

	}

}

<?php

namespace FreshJones\Office\Services\Simulations;


use Freshjones\Core\Helpers\Container;
use FreshJones\Office\Services\Services\ServiceInterface;
use \App\Services\Simulation;


class MarketingSimulator extends Simulator
{
	

	//private $outputcount;

	/*
		the job of a simulator is to simulate a service
		a services job is to convert its inputs into outputs
		so a simulators job is to log statistics about how the service performed
		and return the outputs the service would have produced
	*/
	public function run(ServiceInterface $service, Simulation $simulation)
	{

		//$this->service 		= $service;
		//$this->simulation 	= $simulation;

		$outputCount = $this->getOutputCount();


		$this->populateQueue();

	}

	private function populateQueue()
	{

		if(!$this->outputcount)
			return;

		$serviceOutputs = $this->service->get('outputs');
		
		$delays = array("start"=>null,"finish"=>null);

		/*
		if($this->getConfigValue('startdelays'))
		{

			$startDelay =  new QueueDelay(
					$startDelays['probability'],
					$startDelays['cost'],
					$startDelays['reason']
				);
		}
		
		if($finishdelays = $this->getConfigValue('finishdelays'))
		{
			$delays["finish"] = $this->simulation->getQueueDelay
					(
						$finishdelays['probability'],
						$finishdelays['cost'],
						$finishdelays['reason']
					);
		}
		*/

		$queue = $this->simulation->getQueue();


echo '<pre>';
print_r($this->getDelays());
echo '</pre>';
die();
		for($i=0; $i<$this->outputcount; $i++)
		{

			foreach($serviceOutputs->getOutputs() AS $key => $output)
			{
				
				$processor = $this->simulation->getQueueProcessor();

				$processor->setOutput($output);

				$queue->register($processor);

			
				//here we need to create an 
				//$processMonth = $this->getProcessMonth(); 

				//$processor = $this->getProcessor($output);

				//$queue->register($processMonth, $this);

			}

		}

		//$processor = $this->simulation->getProcessor();
		//$processor->process($this);

	}

	private function getOutputCount()
	{

		$output = 0;

		$count = $this->helpers->getRandomMinMaxValue($this->config['opportunities']);

		echo '<pre>';
		print_r($count);
		echo '</pre>';
		die();
		//$this->outputcount = 0;

		/*
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
				$this->outputcount += 1;
				$logger->addRecord($department, $service, 'Converted', 1);
			}

		}
		*/

	}

}

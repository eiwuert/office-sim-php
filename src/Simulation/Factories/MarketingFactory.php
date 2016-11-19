<?php

namespace Simulation\Factories;

use Simulation\Services\Queue;
use Simulation\Services\Processor;
use Simulation\Services\Logger;
use Simulation\Contracts\MarketingServiceRepository;
use Simulation\Helpers\SimulationHelpers;

class MarketingFactory
{
	private $helpers;
	private $services;
	private $queue;
	private $logger;
	
	public function __construct
	(
		MarketingServiceRepository $services, 
		SimulationHelpers $helpers,  
		Queue $queue, 
		Logger $logger
	)
	{
		$this->services = $services;
		$this->helpers = $helpers;
		$this->queue = $queue;
		$this->logger = $logger;
	}

	public function run()
	{		
		foreach($this->services->all() AS $key => $service)
		{	
			$this->runService($service);
		}
	}

	private function runService($service)
	{

		$count = $this->getOpportunityCount
			(
				$service->department, 
				$service->name, 
				$service->simulation['opportunities'], 
				$service->simulation['probability']['value']
			);

		if(!$count)
			return;

		for($i=0; $i<$count; $i++)
		{

			$processor = new Processor($service);

			//register the processor object in the queue

		}

	}

	private function getOpportunityCount($department, $name, $opportunities, $probability)
    {

        $count = 0;
        
        $attempts = $this->helpers->getRandomMinMaxValue( $opportunities );

        $this->logger->addRecord($department, $name, 'Attempted', $attempts);

        if(!$attempts)
            return $count;

        for($i=0;$i<$attempts;$i++)
        {

            if(!$this->helpers->getRandomProbability( $probability ) )
            {
                $this->logger->addRecord($department, $name, 'Missed', 1);
            } 
            else 
            {
                $count += 1;
                $this->logger->addRecord($department, $name, 'Converted', 1);
            }

        }

        return $count;

    }


}
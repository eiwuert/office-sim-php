<?php

namespace App\Services;

use \FreshJones\Office\Services\Simulations\SimulatorInterface;

/*
	a queue processors job is to wrap a services output 
	obligations in a processor object to pass into the queue 
*/
class MarketingQueueProcessor extends QueueProcessor
{

	public function addProcessesToQueue(SimulatorInterface $simulation)
	{

		$outputcount = $simulation->getOutputCount();
		$service = $simulation->getService();
		$helpers = $simulation->getHelpers();
		$queue = $simulation->getSimulation()->getQueue();
		
		$outputs = $service->get('outputs');


		//process time equals the hour now + whatever processtime is necessary
		//if we are at the end of the year we'll need to start on this next year
		$now = $this->timer->getCurrentValue('hour') < 8640 ? $this->timer->getCurrentValue('hour') : 0;

		$processTime =  $now + $helpers->getRandomMinMaxValue( $service->get('simulation')['processtime'] );
		
		
		
	}	

}
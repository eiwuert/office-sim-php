<?php

namespace App\Services;

use Freshjones\Core\Helpers\SimulationHelpers;
use \FreshJones\Office\Services\Simulations\SimulatorInterface;

interface QueueProcessorInterface {

  public function addProcessesToQueue(SimulatorInterface $service);
}

/*
	The queues job is to store processes and release them at the specified time interval
	This allows us to simulate real life events that do not happen immediately when they are intiated
	The Queue will require a timer so that it can look at events that should happen within a certain timeframe
	It will then run those events until there are no more and then end its cycle
*/
abstract class QueueProcessor implements QueueProcessorInterface
{
	protected $helpers;
	protected $timer;
	
    public function __construct(Timer $timer)
    {
    	$this->timer = $timer;
    	$this->helpers = new SimulationHelpers();
    }

    abstract function addProcessesToQueue(SimulatorInterface $service);

}
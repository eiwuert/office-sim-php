<?php

namespace Simulation\Services;

//use FreshJones\Core\Helpers\Container;

//use \FreshJones\Office\Contracts\ServiceContract;

/*
	The queues job is to store processes and release them at the specified time interval
	This allows us to simulate real life events that do not happen immediately when they are intiated
	The Queue will require a timer so that it can look at events that should happen within a certain timeframe
	It will then run those events until there are no more and then end its cycle
*/
class Queue
{
   	
   	private $registry;
   	private $logger;
    
    public function __construct(Logger $logger)
    {
    	$this->logger = $logger;
    }

    public function run()
    {
      
      $processes = $this->getProcesses();

      if(!$processes)
        return;

      foreach($processes AS $process)
      {
        $process->getSimulator()->run($process);
      }

      //run it until there are none
      $this->run();
      
    }

    private function getProcesses()
    {
      
      if(
          !$this->registry || 
          !is_array($this->registry) || 
          empty($this->registry)
        )
      {
        return false;
      }
        
      $period = $this->logger->getTimer()->getCurrentValue('month');

      if(
          !isset($this->registry['Period-' . $period]) || 
          !is_array($this->registry['Period-' . $period]) || 
          empty($this->registry['Period-' . $period]) 
        )
      {
        return false;
      }

      //get the processes for this period
      $processes = $this->registry['Period-' . $period];

      //unset the period period in the registry
      unset($this->registry['Period-' . $period]);

      //return the processes
      return $processes;

    }

    public function register($period, $process)
    {
      $this->registry['Period-' . $period][] = $process;
    }

}
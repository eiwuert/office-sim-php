<?php

namespace App\Services;

//use FreshJones\Core\Helpers\Container;

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
    private $timer;

    public function __construct(Logger $logger)
    {
    	$this->logger = $logger;
      $this->timer = $logger->getTimer();
    }

    public function run()
    {
      
      //run the queue
      $processes = $this->getProcesses();

      if(!$processes)
        return;

      echo '<pre>';
      print_r($processes);
      echo '</pre>';
      die();
      foreach($processes AS $k => $processor)
      {
          $processor->delay_or_process($this);
      }

      $this->run();
      
    }

    public function log($department,$service,$key,$value)
    {
      
        $this->logger->addRecord(
            $department,
            $service, 
            $key, 
            $value
        );

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
        
      $currentMonth = $this->timer->getCurrentValue('month');

      if(
          !isset($this->registry['Month ' . $currentMonth]) || 
          !is_array($this->registry['Month ' . $currentMonth]) || 
          empty($this->registry['Month ' . $currentMonth]) 
        )
      {
        return false;
      }

      $processes = $this->registry['Month ' . $currentMonth];

      unset($this->registry['Month ' . $currentMonth]);

      return $processes;

    }


    public function register(QueueProcessor $processor)
    {

      $month = $processor->startOn();

      $this->registry['Month ' . $month][] = $processor;
    }

}
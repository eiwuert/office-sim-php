<?php

namespace App\Services;

//use FreshJones\Core\Helpers\Container;

use \FreshJones\Office\Contracts\ServiceContract;

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
      $services = $this->getServices();

      if(!$services)
        return;

      foreach($services AS $service)
      {
        
        if( $delayPeriod = $service->getParam('Simulator')->delay() )
        {
            $this->register($delayPeriod, $service);
        } 
        else 
        {
            $service->finish();
        }   

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

    private function getServices()
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
          !isset($this->registry['Period ' . $currentMonth]) || 
          !is_array($this->registry['Period ' . $currentMonth]) || 
          empty($this->registry['Period ' . $currentMonth]) 
        )
      {
        return false;
      }

      //get the services for this period
      $services = $this->registry['Period ' . $currentMonth];

      //unset the current period in the registry
      unset($this->registry['Period ' . $currentMonth]);

      //return the services
      return $services;

    }

    public function register($period, ServiceContract $service)
    {
      $this->registry['Period ' . $period][] = $service;
    }

}
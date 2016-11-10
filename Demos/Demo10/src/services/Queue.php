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
   	private $timer;

    public function __construct(Timer $timer)
    {
    	$this->timer = $timer;
    }

    public function run()
    {
      //run the queue
    }

    public function register(QueueProcessInterface $process)
    {
      $this->registry[] = $process;
    }

}
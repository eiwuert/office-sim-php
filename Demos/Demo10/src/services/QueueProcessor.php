<?php

namespace App\Services;

//use Freshjones\Core\Helpers\SimulationHelpers;
//use \FreshJones\Office\Services\Simulations\ServiceSimulatorInterface;


/*
	The queue processors job is to prepare a simulations outputs for the queue
	it turns them into process objects and enters them into the queue
*/
class QueueProcessor 
{

    private $output;
    private $delays;

    public function __construct()
    {
    	
    }

    public function startOn()
    {
        return 1;
    }

    public function setDelay($key, QueueDelay $delay)
    {
        $this->delays[$key] = $delay;
    }

    public function setOutput($output)
    {
        $this->output = $output;
    }
   
}
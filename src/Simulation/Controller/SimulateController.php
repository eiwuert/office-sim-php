<?php
namespace Simulation\Controller;

use Simulation\Services\Simulation;
use Simulation\Services\Statistics;

class SimulateController
{	

    private $statistics;
    private $simulation;
   	
   	public function __construct(Simulation $simulation, Statistics $statistics)
   	{	
        $this->statistics = $statistics;  
     		$this->simulation = $simulation;	
   	}

    public function __invoke()
    {
      
      //run the simulation
    	$this->simulation->run();

      //set the stats after the simulation has run
      $this->statistics->set();

      //return the statistics
      echo $this->statistics->all();
    
    }
    
}
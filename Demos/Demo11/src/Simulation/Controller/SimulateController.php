<?php
namespace Simulation\Controller;

use Simulation\Services\SimulationService;

class SimulateController
{	

	private $simulation;
   	
   	public function __construct(SimulationService $simulation)
   	{	
   		$this->simulation = $simulation;	
   	}

    public function __invoke()
    {
    	$this->simulation->run();
        //echo $this->simulation->statistics();
    }
    
}
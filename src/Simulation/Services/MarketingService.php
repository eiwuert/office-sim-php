<?php

namespace Simulation\Services;

use Simulation\Contracts\MarketingServiceRepository;

/* I run all marketing related services for a time period */
class MarketingService
{
    
    private $serviceRepository;
    private $simulator;

    public function __construct
    (
    	MarketingServiceRepository $serviceRepository,
    	MarketingServiceSimulator $simulator
    )
    {
    	$this->serviceRepository = $serviceRepository;
    	$this->simulator = $simulator;
    }

    //run marketing for a month
    public function run()
    {
    	//we simulate all lead generating services
    	foreach( $this->serviceRepository->all() AS $service)
        {
            $this->simulator->initialize($service);
        }	
    }

}

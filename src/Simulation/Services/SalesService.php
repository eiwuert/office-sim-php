<?php

namespace Simulation\Services;

use Simulation\Contracts\EntityRepository;

/* I run all sales related activities for a time period */
class SalesService
{
    
    private $entityRepository;
    private $simulator;

    public function __construct
    (
    	EntityRepository $entityRepository,
        SalesServiceSimulator $simulator
    )
    {
    	$this->entityRepository = $entityRepository;
        $this->simulator = $simulator;
    }

    //run sales for a month
    public function run()
    {

        if(!$this->entityRepository->get('lead'))
            return;
        
        //we simulate all lead generating services
        foreach( $this->entityRepository->get('lead') AS $service)
        {
            $this->simulator->initialize($service);
        }
    }

}

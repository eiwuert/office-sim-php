<?php

namespace App\Simulation\Includes;

use App\Contracts\Simulation\SimulationInterface;
use App\Contracts\Simulation\TimerInterface;
use App\Contracts\Support\DataInterface;
use App\Contracts\Office\OfficeInterface;

class Simulation implements SimulationInterface
{
   	
    private $timer;
   	private $settings;
    private $office;

    public function __construct(TimerInterface $timer, DataInterface $data)
    {
    	$this->settings = $data->getData('settings'); 
    	$this->timer = $timer;       
    }

    //run the simulation
    public function run(OfficeInterface $office)
    {

        $this->office = $office;

        //initialize the timer
        $this->timer->init();

        for($i=0; $i < $this->settings['iterations']; $i++)
        { 
            $this->timer->reset();
            $this->timer->increment('iteration');
            $this->timer->increment('year');

            // run the iteration
            $this->iterate();
        }

    }

    private function iterate()
    {
        //each iteration is a year so it runs 12 times (once per month)
        for($i=1; $i<=12; $i++)
        {
            
            //increment the timer for each month
            $this->timer->incrementMonth($i * 720);

            //we must now run the offices department simulations
            $departments = $this->office->getDepartments();

            foreach($departments AS $department)
            {
                $department->simulate();
            }

        }

    }

}

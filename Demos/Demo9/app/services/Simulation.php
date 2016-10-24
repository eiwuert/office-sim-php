<?php

namespace App\Services;

use Core\App;

class Simulation
{
    private $timer;
    private $statistics = array();

    public function __construct(Timer $timer)
    {
        $this->timer = $timer;


    }

    public function run()
    {

        $this->timer->init();
        $settings = App::get('config')['similation'];

        for($i=0; $i < $settings['iterations']; $i++)
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

            $this->statistics[] = $this->timer->getCurrentValue('day');
            //we must now run the offices department simulations
            //$departments = $this->office->getDepartments();
            
            /*
            foreach($departments AS $department)
            {
                $department->simulate();
            }
            */

        }

    }

    public function statistics()
    {
        return $this->statistics;
    }

}

<?php

namespace Simulation\Services;

use Core\App;
//use Office\Office;

class Simulation
{
    private $departments;

    private $timer;
    private $logger;
    private $statistics = array();

    public function __construct()
    {
        $this->timer = App::get('timer');
        $this->logger = App::get('logger');
    }

    public function run()
    {

        $this->departments = App::get('departments');

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

            $this->logger->addRecord('Marketing','Blah','Whats Up??');
            //$this->statistics[] = $this->timer->getCurrentValue('day');
            
            $departments = $this->departments->all();
       
            foreach($departments AS $department)
            {
                
                $department->simulate();
                //$queue = App::get('queue');

            }

        }

    }

    public function statistics()
    {
       return $this->logger->getLog();
    }

}

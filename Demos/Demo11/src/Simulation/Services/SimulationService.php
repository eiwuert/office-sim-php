<?php

namespace Simulation\Services;


class SimulationService
{
    private $config;
    private $timer;
 
    public function __construct(Timer $timer, $config)
    {

        $this->config = $config;
        $this->timer = $timer;
    }

    public function run()
    {

        $this->timer->init();

        for($i=0; $i < $this->config['iterations']; $i++)
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

            echo 'boom' . "<br/>";
            //$this->logger->addRecord('Time','Months','Month ' . $i, 1);

            //$thisRunMarketing()
            //run through the departments
            //$this->runDepartmentsForAMonth();

            //run through the departments
            //$this->runQueueForAMonth();
        }

    }

    /*
    public function statistics()
    {

        $statistics = $this->statistics;

        $statistics->set();

        return $statistics->get();
        
    }
    */

}

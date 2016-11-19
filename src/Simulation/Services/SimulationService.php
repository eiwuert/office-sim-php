<?php

namespace Simulation\Services;

class SimulationService
{
    private $marketing;
    private $sales;
    private $config;
    private $timer;
    private $queue;
 
    public function __construct(
            Timer $timer, 
            $config, 
            $marketing,
            $sales,
            $queue
        )
    {
        $this->marketing = $marketing;
        $this->sales = $sales;
        $this->config = $config;
        $this->timer = $timer;
        $this->queue = $queue;
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

            //run marketing
            $this->marketing->run();
            
            echo '<pre>';
            print_r($this->queue);
            echo '</pre>';
            die();
            //run queue
            //$this->queue->run();
            
            //run sales
            //$this->sales->run();

            //run queue
           // $this->queue->run();

            
            //run production
            
            
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

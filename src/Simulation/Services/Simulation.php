<?php

namespace Simulation\Services;

use Simulation\Factories\MarketingFactory;

class Simulation
{
    private $config;
    private $timer;
    private $queue;
    private $marketing;

    public function __construct($config, Timer $timer, Queue $queue, MarketingFactory $marketing)
    {
        $this->config = $config;
        $this->timer = $timer;
        $this->queue = $queue;
        $this->marketing = $marketing;
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
                
            //run marketing factory
            $this->marketing->run();


            //increment the timer for each month
            $this->timer->incrementMonth($i * 720);


            

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

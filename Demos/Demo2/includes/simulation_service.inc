<?php

namespace SimulationService;

class Simulation
{
    private $timer;
    private $services;
    private $backlog;
    private $config;
    private $logger;

    public function __construct(\Logger $logger,\Backlog $backlog,\Office $office, \Timer $timer, $config)
    {
        
        $this->config       = $config;
        $this->logger       = $logger;
        $this->backlog      = $backlog;
        $this->office       = $office;
        $this->timer        = $timer;
  
    }

    public function runSimulation()
    {
        //initialize the timer
        $this->timer->init();

        for($i=0; $i < $this->config['iterations']; $i++)
        { 
            $this->timer->reset();
            $this->timer->increment('iteration');
            $this->timer->increment('year');

            // run the iteration
            $this->runIteration();
        }

    }

    private function runIteration()
    {
       
        //run every month within an iteration;
        for($i=1; $i<=12; $i++)
        {
            //increment the timer (pretend a month has just gone by)
            $this->timer->incrementMonth($i * 720);

            //run the office services
            $this->office->runServices();

            //run the backlog
            //$this->backlog->run();

        }

        $backlog = $this->backlog->getBacklog();

     
    }
   
}
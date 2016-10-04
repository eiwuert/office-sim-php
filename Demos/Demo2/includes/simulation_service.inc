<?php

namespace SimulationService;

use ProcessServices\ProcessService as ProcessService;
use OfficeServices\OfficeServices as OfficeServices;
use TimeServices\TimeServices as TimeServices;

class Simulation
{
    private $timer;
    private $services;
    private $processor;
    private $config;

    public function __construct($config, TimeServices $timer, ProcessService $processor, OfficeServices $office)
    {
        $this->config       = $config;
        $this->office       = $office;
        $this->timer        = $timer;
        $this->processor    = $processor;
    }

    public function runSimulation()
    {
        //initialize the timer
        $this->timer->init();

        for($i=0; $i < $this->config['iterations']; $i++)
        { 
            $this->timer->reset();
            $this->timer->increment('iteration');

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

            //run the processor
            $this->processor->run();

        }

    }
   
}
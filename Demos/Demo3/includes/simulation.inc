<?php

//namespace SimulationService;

class Simulation
{
    private $timer;
    private $office;
    private $config;

    public function __construct(TimerService $timer, OfficeService $office, $config)
    {
        $this->config       = $config;
        $this->timer        = $timer;
        $this->office       = $office;
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

            //run the office backlog
            $this->office->runBacklog();

        }

    }
   
}
<?php

namespace App\Services;

use FreshJones\Core\Helpers\Container;

class Simulation
{
    private $departments;

    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function run()
    {

        $timer = $this->getTimer();

        $timer->init();

        $settings = $this->app->get('config')['similation'];

        for($i=0; $i < $settings['iterations']; $i++)
        { 
            
            $timer->reset();
            $timer->increment('iteration');
            $timer->increment('year');

            // run the iteration
            $this->iterate();

        }

    }

    public function getLogger()
    {
        return $this->app->get('logger');
    }

    public function getQueue()
    {
        return $this->app->get('queue');
    }

    public function getQueueProcessor()
    {
        //return $this->app->get('queueprocessor');

        return new QueueProcessor();
    }
    
    /*
    public function getQueueDelay()
    {
        return new QueueDelay();
    }
    */
    
    public function getTimer()
    {
        return $this->app->get('timer');
    }

    public function getOffice()
    {
        return $this->app->get('office');
    }

    private function iterate()
    {

        //each iteration is a year so it runs 12 times (once per month)
        for($i=1; $i<=12; $i++)
        {
            //increment the timer for each month
            $this->getTimer()->incrementMonth($i * 720);

            //run through the departments
            $this->runDepartmentsForAMonth();

            //run through the departments
            $this->runQueueForAMonth();

        }

    }

    private function runQueueForAMonth()
    {
        
        $this->getQueue()->run();

        die();

    }

    private function runDepartmentsForAMonth()
    {

        $office = $this->getOffice();
        $departments = $office->getDepartments();
            
        foreach($departments->all() AS $department)
        {   

            $services = $department->get('services');
            
            if( !$services->all() )
                continue;
            
            foreach($services->all() AS $service)
            {
                $service->simulate($this);
            }
            
        }

    }

    public function statistics()
    {

        $statistics = $this->app->get('statistics');

        $statistics->set();

        return $statistics->get();
        
    }

}

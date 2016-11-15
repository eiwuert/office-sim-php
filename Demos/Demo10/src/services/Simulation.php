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
    }

    private function runDepartmentsForAMonth()
    {

        $office = $this->getOffice();
        $departments = $office->getDepartments();
        $queue = $this->getQueue();
        $timer = $this->getTimer();
        $logger = $this->getLogger();

        foreach($departments AS $department => $services)
        {   

            foreach($services AS $service)
            {

                //set the logger on the service simulator
                $service->getParam('Simulator')->setLogger($logger);

                $serviceInstances = $service->start();

                if(!$serviceInstances)
                    continue;

                foreach($serviceInstances AS $instance)
                {
                    $start = $service->getParam('Simulator')->start($timer);
                    $queue->register($start, clone $service);
                }
                
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

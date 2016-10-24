<?php

namespace App\Departments\Services;

interface ServiceSimulationInterface
{

}

abstract class ServiceSimulation implements ServiceSimulationInterface
{
    private $service;
    public function __construct()
    {
    	//$this->settings = $settings;
    }

    public function run(ServiceInterface $service)
    {
        $this->service = $service;
        $this->settings = $this->service->getSettings();
        
        echo 'now we simulate a service <br>';
    }

}

<?php

namespace App\Departments\Services;

interface ServiceInterface
{
}

abstract class Service implements ServiceInterface
{
	protected $settings;
    protected $simulation;
    
    public function __construct(Array $data, ServiceSimulationInterface $simulation)
    {
        $this->settings = $data;
        $this->simulation = $simulation;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function simulate()
    {
    	$this->simulation->run($this);
    }
    
}

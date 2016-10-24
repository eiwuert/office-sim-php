<?php

namespace App\Departments;

use App\Contracts\Departments\DepartmentInterface;
use App\Departments\Services\ServicesInterface;

abstract class Department implements DepartmentInterface
{
	
    protected $services;
	//protected $settings;
    //, DataInterface $data
    public function __construct(ServicesInterface $services)
    {
        $this->services = $services;
    	//$this->settings = $data->getData('settings');
    }

    public function simulate()
    {
    	
        $services = $this->services->getAll();

        if(!$services)
            return;

        foreach($services AS $service)
        {
            $service->simulate();
        }
        

    }

}

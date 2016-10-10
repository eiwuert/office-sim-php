<?php

namespace App\Includes\Departments;

use App\Includes\DataInterface;
use App\Includes\Departments\Services\ServicesInterface;

interface DepartmentInterface
{
}

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

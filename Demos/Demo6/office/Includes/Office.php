<?php

namespace App\Includes;

use App\Contracts\Office\OfficeInterface;
use App\Contracts\Departments\DepartmentsInterface;
use App\Contracts\People\PersonsInterface;
use App\Contracts\Simulation\SimulationInterface;

class Office implements OfficeInterface
{
    private $departments;
    private $people;
    private $simulation;

    public function __construct(
    	DepartmentsInterface $departments, 
    	PersonsInterface $people,
    	SimulationInterface $simulation
    )
    {
        $this->departments 	= $departments;
        $this->people 		= $people;
        $this->simulation 	= $simulation;
    }

    public function simulate()
    {
        $this->simulation->run($this);
    }

    public function getDepartments()
    {
        return $this->departments->getAll();
    }

}

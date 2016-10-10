<?php

namespace App\Includes;

use App\Includes\Departments\DepartmentsInterface;
use App\Includes\PersonsInterface;
use App\Includes\Simulation\Includes\SimulationInterface;

interface OfficeInterface
{
    public function simulate();

}

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

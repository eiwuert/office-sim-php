<?php

interface DepartmentInterface
{
    public function getSimulation();
}

abstract class Department implements DepartmentInterface
{
	protected $simulation;

    public function __construct(DepartmentSimulation $simulation)
    {
        $this->simulation = $simulation;
    }

    public function getSimulation()
    {
    	return $this->simulation;
    }
}

<?php

/*  */

interface DepartmentServicesInterface
{
	public function addService(DepartmentService $service);
	public function getServices();
}

class DepartmentServices implements DepartmentServicesInterface
{

	private $services;

	public function addService(DepartmentService $service)
	{
		$this->services[] = $service;
	}

	public function getServices()
	{
		return $this->services;
	}

	public function run()
	{
		
		$services = $this->getServices();

		foreach($services AS $service)
		{
			$service->simulate();
		}
		
	}

}
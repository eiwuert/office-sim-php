<?php

/* create and return all service objects for a department */

interface DepartmentServiceInterface
{
	public function getService();
}

class DepartmentService implements DepartmentServiceInterface
{
	private $simulation;
	private $service;

	public function __construct($data, Simulation $simulation)
	{
		$this->simulation = $simulation;
		$this->createService($data);
	}

	private function createService($data)
	{
		$service = new stdClass();
		$service->name = $data['name'];

		$this->service = $service;

	}

	public function getService()
	{
		return $this->service;
	}

	public function simulate()
	{
		echo 'simulate';
	}

}
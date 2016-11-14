<?php

namespace FreshJones\Office\Services\Services;

//use Freshjones\Core\Helpers\Container;

class Office
{
		
	private $departments;

	public function __construct($departments)
	{
		$this->departments = $departments;
	}
	
	/*
	private $departments;

	public function setDepartment($name,$config)
	{
		$this->departments[$name] = $config;
	}

	public function getDepartments()
	{
		return $this->departments;
	}
	*/

}
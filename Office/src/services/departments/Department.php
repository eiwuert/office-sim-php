<?php

namespace FreshJones\Office\Services\Departments;

//use Freshjones\Core\Helpers\Container;
//use FreshJones\Office\Services\Services\ServiceContainer;

class Department
{	

	private $name;
	private $config;

	public function __construct($name, $config)
	{
		$this->name = $name;
		$this->config = $config;
	}
	
}
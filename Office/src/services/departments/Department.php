<?php

namespace FreshJones\Office\Services\Departments;

use Freshjones\Core\Helpers\Container;
use FreshJones\Office\Services\Services\ServiceContainer;

class Department extends Container
{	

	public function __construct($name)
	{
		$this->set('name',$name);
	}
	
	public function setServices(ServiceContainer $services)
	{
		$this->set('services',$services);
	}
	
}
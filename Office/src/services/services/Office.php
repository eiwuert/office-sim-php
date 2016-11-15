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
	
	public function getDepartments()
	{
		return $this->departments;
	}	

}
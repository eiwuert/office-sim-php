<?php
namespace Simulation\Models;

class Entity
{
	public function __construct($type)
	{	
		$this->type = $type;
	}

	public function setConfig($config)
	{
		foreach($config AS $key => $value)
		{
			$this->{$key} = $value;
		}
	}

}
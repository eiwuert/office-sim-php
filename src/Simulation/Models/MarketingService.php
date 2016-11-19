<?php
namespace Simulation\Models;

class MarketingService
{

	public function __construct($config)
	{	
		foreach($config AS $key => $value)
		{
			$this->{$key} = $value;
		}
	}

	public function __toString()
	{
		return json_encode($this);
	}

}
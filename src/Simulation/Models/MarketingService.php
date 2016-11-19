<?php

namespace Simulation\Models;

use Simulation\Contracts\Model;

class MarketingService implements Model
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
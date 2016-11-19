<?php

namespace Simulation\Services;

use Simulation\Contracts\Model as Service;

class Processor
{
	
	private $service;

	public function __construct(Service $service)
    {
    	$this->service = $service;
    }

}
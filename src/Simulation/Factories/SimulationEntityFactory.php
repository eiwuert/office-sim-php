<?php
namespace Simulation\Factories;

use Simulation\Models\Entity;

class SimulationEntityFactory
{

	public function __construct()
	{	
		
	}

	public function make()
	{
		return new Entity();
	}
	
}
<?php

namespace FreshJones\Office\Services\Simulations;


interface ServiceSimulatorFactoryInterface 
{
	
}

class BaseSimulatorFactory implements ServiceSimulatorFactoryInterface
{	

	public function make()
	{
		return new BaseSimulator();
	}

}
<?php

namespace FreshJones\Office\Services\Simulations;


interface ServiceSimulatorFactoryInterface 
{
	
}

class BaseSimulatorFactory implements ServiceSimulatorFactoryInterface
{	

	public function make($config)
	{
		return new BaseSimulator($config);
	}

}
<?php

/*  */

interface ServiceSimulationInterface
{

}

class BasicSimulation implements ServiceSimulationInterface
{
	private $processor;
	
	public function __construct(ProcessorService $processor)
	{
		$this->processor = $processor;
	}


}
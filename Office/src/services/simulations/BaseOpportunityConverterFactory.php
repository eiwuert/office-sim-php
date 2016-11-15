<?php

namespace FreshJones\Office\Services\Simulations;


interface OpportunityConverterFactoryInterface 
{
	
}

class BaseOpportunityConverterFactory implements OpportunityConverterFactoryInterface
{	

	private $helpers;

	public function __construct($helpers)
	{
		$this->helpers 			= $helpers;
	}

	public function make()
	{
		return new BaseOpportunityConverter($this->helpers);
	}

}
<?php

namespace FreshJones\Office\Services\Simulations;

interface DelayerFactoryInterface
{

}

class MonthlyDelayerFactory implements DelayerFactoryInterface
{

	private $helpers;

	public function __construct($helpers)
	{
		$this->helpers = $helpers;
	}
	
	public function make()
	{
		return new MonthlyDelayer($this->helpers);
	}
}
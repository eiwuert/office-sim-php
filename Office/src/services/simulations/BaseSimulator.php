<?php

namespace FreshJones\Office\Services\Simulations;


class BaseSimulator
{
	private $config;
	private $delays;

	public function __construct($config)
	{
		$this->config = $config;
	}

	public function setDelay($name,$delay)
	{
		$delays[$name] = $delay;
	}
}
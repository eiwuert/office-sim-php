<?php

namespace FreshJones\Office\Services\Services;

interface ServiceOutputFactoryInterface
{

}

class ServiceOutputFactory implements ServiceOutputFactoryInterface
{

	public function __construct()
	{
		
		
		
	}

	public function make()
	{
		return new ServiceOutput();
	}

}
<?php

namespace FreshJones\Office\Services\Simulations;

class DelayFactory
{

	public function make($config=array())
	{
		return new Delay($config);
	}
}
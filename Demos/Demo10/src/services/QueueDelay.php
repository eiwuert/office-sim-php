<?php

namespace App\Services;


class QueueDelay
{	  
	private $probability;
	private $costs;
	private $reasons;

	public function __construct($probability=0,$costs=array(),$reasons=array())
	{
		$this->probability = $probability;
		$this->costs = $costs;
		$this->reasons = $reasons;
	}

}
<?php

namespace ServiceSimulationStatistics;	

class Statistics
{
	
	private $stats;

	public function set($stat,$value)
	{
		$this->stats[$stat] = $value;
	}

	public function get()
	{
		return $this->stats;
	}

	public function getStat($stat)
	{
		return isset($this->stats[$stat]) ? $this->stats[$stat] : false;
	}

	public function sum($stat,$value)
	{
		if(!isset($this->stats[$stat]))
			$this->stats[$stat] = 0;

		$this->stats[$stat] += $value;
	}

}
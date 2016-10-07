<?php

namespace StatisticsServices;	

class StatisticsService
{
	
	private $stats;

	public function __construct()
	{
		
	}

	private function initStatType($type)
	{
		$this->stats[$type] = array();
	}

	private function initStat($type,$statistic)
	{
		$this->stats[$type][$statistic] = array('current'=>array(), 'cumulative'=>array(), 'average'=>array(), 'count' => 0 );
	}

	private function setCounter($type, $statistic, $value)
	{
		$this->stats[$type][$statistic]['count'] = $value;
	}

	private function setStat($type, $statistic, $param, $value)
	{
		if(!isset($this->stats[$type][$statistic]['current'][$param]))
			$this->stats[$type][$statistic]['current'][$param] = 0;
		$this->stats[$type][$statistic]['current'][$param] = $value;

		if(!isset($this->stats[$type][$statistic]['cumulative'][$param]))
			$this->stats[$type][$statistic]['cumulative'][$param] = 0;
		$this->stats[$type][$statistic]['cumulative'][$param] += $value;

		if(!isset($this->stats[$type][$statistic]['average'][$param]))
			$this->stats[$type][$statistic]['average'][$param] = 0;
		$this->stats[$type][$statistic]['average'][$param] = $this->stats[$type][$statistic]['cumulative'][$param] / $this->stats[$type][$statistic]['count'];
	}

	public function add($type, $statistic, $iteration, $param, $value)
	{

		if(!isset($this->stats[$type])) $this->initStatType($type);

		if(!isset($this->stats[$type][$statistic])) $this->initStat($type,$statistic);

		$this->setCounter($type, $statistic, $iteration);

		$this->setStat($type, $statistic, $param, $value);

	}
	

}
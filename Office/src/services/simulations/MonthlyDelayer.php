<?php

namespace FreshJones\Office\Services\Simulations;

use \App\Services\Logger;

interface DelayerInterface
{
	public function delayStart($department,$service,Logger $logger);
	public function delayFinish($department,$service,Logger $logger);
}

class MonthlyDelayer implements DelayerInterface
{
	private $helpers;
	private $processtime;
	private $startdelays;
	private $finishdelays;

	public function __construct($helpers) 
	{
		$this->helpers = $helpers;
	}
	
	public function setProcessDelays($config)
	{
		$this->processtime['values'] = isset($config['values']) && is_array($config['values']) ? $config['values'] : [[0,0]];
		$this->processtime['weights'] = isset($config['weights']) && is_array($config['weights']) ? $config['weights'] : [100];
	}

	public function setStartDelays($config)
	{

		$this->startdelays['probability'] = isset($config['probability']['value']) && is_numeric($config['probability']['value']) ? $config['probability']['value'] : 0;
		$this->startdelays['costs'] = isset($config['cost']) && is_array($config['cost']) ? $config['cost'] : false;
		$this->startdelays['reasons'] = isset($config['reason']) && is_array($config['reason']) ? $config['reason'] : false;
	}

	public function setFinishDelays($config)
	{
		$this->finishdelays['probability'] = isset($config['probability']['value']) && is_numeric($config['probability']['value']) ? $config['probability']['value'] : 0;
		$this->finishdelays['costs'] = isset($config['cost']) && is_array($config['cost']) ? $config['cost'] : false;
		$this->finishdelays['reasons'] = isset($config['reason']) && is_array($config['reason']) ? $config['reason'] : false;
	}

	public function getDelay($type)
	{
		$delay = false;

		if(!is_array( $this->{$type} ))
			return $delay;

		$probability = $this->helpers->getRandomProbability( $this->{$type}['probability'] );

		if(!$probability)
			return $delay;


		$delay['reason'] = $this->helpers->getRandomValue( $this->{$type}['reasons'] );
		$delay['cost'] = $this->helpers->getRandomMinMaxValue( $this->{$type}['costs'] );

		return $delay;

	}

	public function delayStart($department,$service,Logger $logger)
	{	

		$timer = $logger->getTimer();

		$startDelay = 0;

		if($delay = $this->getDelay('startdelays'))
		{
			$startDelay = $delay['cost'];
			$logger->addRecord( $department . ' Delays', $service . ': ' . $delay['reason'], 'Frequency', 1);
			$logger->addRecord( $department . ' Delays', $service . ': ' . $delay['reason'], 'Cost in Days', floor($delay['cost']/24) );
		}

		//delay in hours
		$processDelay = $this->helpers->getRandomMinMaxValue($this->processtime) + $startDelay;

		$currentMonth = $timer->getCurrentValue('month');

		return $processDelay < 720 ? $currentMonth : $currentMonth + floor($processDelay / 720);

	}

	public function delayFinish($department,$service,Logger $logger)
	{
		
		$timer = $logger->getTimer();

		$finishDelay = $this->getDelay('finishdelays');

		if(!$finishDelay)
			return $finishDelay;

		$logger->addRecord($department . ' Delays', $service . ': ' . $finishDelay['reason'], 'Frequency', 1);
		$logger->addRecord($department . ' Delays', $service . ': ' . $finishDelay['reason'], 'Cost in Days', floor($finishDelay['cost']/24) );
		
		$currentMonth = $timer->getCurrentValue('month');
		
		return $finishDelay['cost'] < 720 ? $currentMonth : $currentMonth + floor($finishDelay['cost'] / 720);

	}

}	
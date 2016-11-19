<?php

namespace Simulation\Services;

class Timer
{
   
   	private $current;
	private $totals;

    public function init()
    {	
    	//init currents
    	$this->initCurrent(TRUE);

    	//init totals
    	$this->initTotals();
    }

    public function reset()
    {
    	$this->initCurrent();
    }

    public function initCurrent($iteration=FALSE)
    {
    	if($iteration)
		{
			$this->setCurrentValue('iteration', 0);
            $this->setCurrentValue('year', 0);
		}
    	
    	$this->setCurrentValue('month', 0);
    	$this->setCurrentValue('day', 0);
    	$this->setCurrentValue('hour', 0);
    }

    public function initTotals()
    {
    	$this->setTotalValue('iterations', 0);
    	$this->setTotalValue('years', 0);
    	$this->setTotalValue('months', 0);
    	$this->setTotalValue('days', 0);
    	$this->setTotalValue('hours', 0);
    }

    public function setCurrentValue($param, $value)
    {
    	$this->current[$param] = $value;
    }

    public function setTotalValue($param, $value)
    {
    	$this->totals[$param] = $value;
    }

    public function getCurrentValue($param)
    {
    	return $this->current[$param];
    }

    public function getTotalValue($param)
    {
    	return $this->totals[$param];
    }
   
    public function increment($param)
    {	
    	$curVal = $this->getCurrentValue($param);
    	$this->setCurrentValue($param,$curVal+1);

    	$totalHour = $this->getTotalValue($param . 's');
    	$this->setTotalValue($param . 's',$totalHour+1);
    }

    public function incrementByValue($param,$value)
    {  

      $iteration = $this->getCurrentValue('iteration');  

      $this->setCurrentValue($param,$value);

      $paramTotal = $this->getTotalValue($param . 's');
      $this->setTotalValue($param . 's',$value * $iteration);

    }

     public function incrementByOne($param)
    {  
      	$curVal = $this->getCurrentValue($param);
      	$this->setCurrentValue($param,$curVal+1);

      	$totalHour = $this->getTotalValue($param . 's');
    	$this->setTotalValue($param . 's',$totalHour+1);
    }

    public function incrementMonth($hour)
    { 

      $this->incrementByValue('hour',$hour);
      
      $this->incrementByValue('day',floor($hour / 24));

      $this->incrementByValue('month',floor($hour / 720));

      //$this->incrementByValue('year',floor($hour / 8640));

      
      
    }

    public function incrementHour()
    {	
    	$this->increment('hour');

    	$curHour = $this->getCurrentValue('hour');

    	if( ($curHour % 24) == 0 )
    	{
    		$this->increment('day');
    	}

    	if( ($curHour % 720) == 0 )
    	{
    		$this->increment('month');
    	}
    	
    	if( ($curHour % 8640) == 0 )
    	{
    		$this->increment('year');
    	}
    }

    public function getTotals()
    {	
    	return $this->totals;
    }

    public function getCurrent($type='array')
    {	
    	return $type === 'key' ? implode('-',$this->current) : $this->current;
    }

}
<?php

use DepartmentSimulations\DepartmentSimulation as DepartmentSimulation;

class MarketingSimulation extends DepartmentSimulation
{

  private $hit=0;
  private $miss=0;

  //set the opportunities available
  public function runOpportunities()
  {

      $opportunities = $this->helpers->getRandomMinMaxValue($this->config['opportunities']);

      for($i=0; $i<$opportunities; $i++)
      {
          
          if(!$this->getProbability( $this->getConfigValue('probability') ))
          {
          
            $this->setHitMiss('hit');
          
          } else {

             $this->setHitMiss('miss');
          }

      }

  }

  public function setHitMiss($type)
  {
    $this->{$type} += 1;
  }

  public function getHitMiss($type)
  {
    return $this->{$type};
  }

  public function getTotals()
  {
    return $this->hit + $this->miss;
  }

  public function runSimulation()
  {
    
    /* if we have hits we can add a process element for it */
    /* if we have misses we determine what to do with them */
    /* both hits and misses need to be recorded in statistics */
    if($hits = $this->getHitMiss('hit'))
    {

      $processClassName = $this->config['classes']['processClass']['value'];

      for($i=0; $i<$hits; $i++)
      {

        $processClass = new $processClassName();
        $processClass->setProcess($this);
        $process = $processClass->getProcess();

        echo '<pre>';
        print_r( $process);
        echo '</pre>';
        

      }
      
    }


  }

}

class MarketingAdvertisingSimulation extends MarketingSimulation
{

 


}

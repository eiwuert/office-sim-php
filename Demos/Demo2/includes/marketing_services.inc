<?php

namespace MarketingServices;

use DepartmentServices\DepartmentServices as DepartmentServices;

class MarketingServices extends DepartmentServices
{
   
  public function runService()
  {

    foreach($this->getServices() AS $service)
    {
      $simclassname = $service['simulation']['classes']['simulationClass']['value'];

      $simulationClass = new $simclassname($service);
      $simulationClass->runOpportunities();
      $simulationClass->runSimulation();

    }

  }

}

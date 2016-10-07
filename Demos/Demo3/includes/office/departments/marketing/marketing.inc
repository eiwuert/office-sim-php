<?php

//namespace MarketingServices;

//use DepartmentServices\DepartmentServices as DepartmentServices;

class Marketing extends Department
{
  
  /* 
    Each department will have many services that will do work (output) throughout the course of a period in time
    This methods goal is to:
      1) Run all services within a particular department
      2) Record within the backlog queue any work (output processes) this departments services have produced
      3) Record within the metrics object any statistical data the department and its services have produced
  */
  public function runDepartmentServices()
  {

    $departmentName = $this->getName();

    foreach($this->getServices() AS $service)
    {
      
      /* 
        Each service must run through a ServiceSimulation class 
        whose objective it is to simulate how the service would 
        statistically react in real life.
 
        since each service in reality is potentially unique 
        we allow each service to use whichever concrete ServiceSimulation class it wants
      */
        
      $classname = $service['simulation']['classes']['simulationClass']['value'];
      $this->setSimulationClass($classname);
      //$simulationClass = new $classname();


      //WE NEED TO SET THESE SUCKAS
      //$departmentName, $service['name'], $service


      // the goal of each ServiceSimulation class is to generate output processes (backlog objects)
      //$simulationClass->setProcesses();

      /*
      
      $outputs = $simulationClass->getOutputs();

      if($outputs)
      {
        
        foreach($outputs as $output)
        {
          $backlog->addBacklogObject($output);
        }

      }
      
      $statistics = $simulationClass->getStatistics();
      
      */

    }

  }

}

<?php

//namespace DepartmentServices;

/*

  The goals (output) of department objects are

  1) Conversions (i.e. process objects) conversions means that work has taken place and the department services have been doing their specific job of converting inputs to outputs 
  2) Metrics (i.e. statistic objects)

  one possibility here is to inject the simulation backlog and statistic services into the department services for populating
  another possibility is to store them for each time period and have the office service fetch them via get methods

  I'm not sure which is more correct here...

*/ 

interface DepartmentService
{
  public function runDepartmentServices();
}

abstract class Department implements DepartmentService
{

  private $data;
  private $config;
  private $services;

  public function __construct($data)
  {

    $this->data = $data;
    $this->config = $data['config'];
    $this->services = $data['services'];
  }

  protected function setSimulationClass($name)
  {
      echo '<pre>';
      print_r($name);
      echo '</pre>';
      die();
  }
  
  public function getName()
  {
    return $this->data['name'];
  }

  public function getConfig()
  {
    return $this->config;
  }

  public function getServices($all=false)
  {
    
    if($all)
      return $this->services;

    $services = array();
    foreach($this->services AS $service)
    {
      if($service['active'])
        $services[] = $service;
    }

    return $services;
  
  }

  abstract function runDepartmentServices();

}
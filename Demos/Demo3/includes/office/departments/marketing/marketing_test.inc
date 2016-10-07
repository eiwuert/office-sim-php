<?php

interface DepartmentService
{
  public function runDepartmentServices();
}

/*
  
  a departments job is to run through all of its services

*/

class Marketing implements DepartmentService
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


  private function getName()
  {
    return $this->data['name'];
  }

  private function getServices($all=false)
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

  public function runDepartmentServices()
  {

    $departmentName = $this->getName();

    foreach($this->getServices() AS $service)
    {

      

    }
    
  }

}

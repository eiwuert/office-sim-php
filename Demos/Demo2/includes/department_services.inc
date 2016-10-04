<?php

namespace DepartmentServices;

use  ProcessServices\ProcessService as ProcessService;

interface DepartmentServicesInterface
{
  public function runService();
}

abstract class DepartmentServices implements DepartmentServicesInterface
{
  
  private $processor;

  private $data;
  private $config;
  private $services;

  public function __construct(ProcessService $processor, $data)
  {
    $this->data = $data;
    $this->config = $data['config'];
    $this->services = $data['services'];
    $this->processor = $processor;
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

  abstract function runService();

}
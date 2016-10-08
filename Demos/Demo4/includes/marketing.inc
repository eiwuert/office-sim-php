<?php

interface DepartmentInterface
{
  public function runDepartmentServices();
}

/*
  a departments job is to run through all of its services
*/

class Marketing implements DepartmentInterface
{
  
  private $services;

  public function __construct(DepartmentServices $services)
  {
    $this->services = $services;
  }

  public function runDepartmentServices()
  {
    $this->services->run(); 
  }

}

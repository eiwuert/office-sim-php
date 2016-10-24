<?php

namespace App\Departments\Services;

interface ServicesInterface
{
    public function setService(ServiceInterface $service);
    public function getService($name);
    public function getAll();
}

class Services implements ServicesInterface
{
    private $services;

    public function __construct(){}

    public function setService(ServiceInterface $service)
    {
        $this->services[] = $service;
    }

    public function getService($name)
    {
        return $this->services[$name];
    }

    public function getAll()
    {
        return $this->services;
    }

}

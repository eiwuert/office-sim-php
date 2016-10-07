<?php

interface OfficeService
{

}

class StdOffice implements OfficeService
{
    
    private $services;
    private $backlog;

    public function __construct(BacklogInterface $backlog)
    {
        $this->backlog = $backlog;
    }

    public function addService(DepartmentService $service)
    {
        $this->services[] = $service;
    }

    public function getServices()
    {
        return is_array($this->services) && !empty($this->services) ? $this->services : false;
    }
    
    public function runServices()
    {

        $services = $this->getServices();

        if(!$services)
            return;

        foreach($services AS $service)
        {
            $service->runDepartmentServices();
        }

    }

    public function runBacklog()
    {
        $this->backlog->run();
    }

}
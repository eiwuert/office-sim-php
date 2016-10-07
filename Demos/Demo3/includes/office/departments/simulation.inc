<?php

//namespace ServiceSimulations;

//use Helpers\Helpers as Helpers;

/* 
    Each service must run through a ServiceSimulation class 
    whose objective it is to simulate how the service would 
    statistically react in actuality

    the goal of each ServiceSimulation class is to: 
    1) Generate output processes
*/
    
interface ServiceSimulationInterface 
{
    public function simulate();
    public function setProcesses();
}

abstract class ServiceSimulation implements ServiceSimulationInterface
{

    protected $logger;
    protected $backlog;

    protected $outputs;
    protected $department;
    protected $service;
    protected $data;
	protected $helpers;
    protected $config;

    //WE NEED THESE SOMEHOW???
    //, $department,$service,$data

    public function __construct(\Helpers\Helpers $helpers,\Logger $logger,\Backlog $backlog)
    {

    	$this->helpers         = $helpers;
        $this->logger          = $logger;
        $this->backlog         = $backlog;
        
    	//$this->service         = $service;
        //$this->data            = $data;
        //$this->department      = $department;
        //$this->config          = $data['simulation'];

        

        //$this->simulate();

    }


    abstract function simulate();
    abstract function setProcesses();

    public function getProbability($probability)
  	{
    	return $this->helpers->getRandomProbability($probability);
  	}

    public function getHelpers()
    {
        return $this->helpers;
    }

    public function getService()
    {
        return $this->service;
    }

    public function getConfig()
    {
        return $this->config;
    }

	public function getConfigValue($value)
	{
		return $this->config[$value]['value'];
	}


}
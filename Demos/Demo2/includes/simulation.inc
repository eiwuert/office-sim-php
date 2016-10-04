<?php

namespace DepartmentSimulations;

use Helpers\Helpers as Helpers;

class DepartmentSimulation
{
    protected $sim;
	protected $helpers;
    protected $config;

    public function __construct($sim)
    {
    	$this->helpers = new Helpers();
    	$this->sim = $sim;
        $this->config = $sim['simulation'];
    }

    public function getProbability($probability)
  	{
    	return $this->helpers->getRandomProbability($probability);
  	}

    public function getHelpers()
    {
        return $this->helpers;
    }

    public function getSim()
    {
        return $this->sim;
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
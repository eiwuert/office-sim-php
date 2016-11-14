<?php

namespace App\Services;

use Freshjones\Core\Helpers\SimulationHelpers;
//use \FreshJones\Office\Services\Simulations\SimulatorInterface;

class Delay
{	
	private $config;
	private $helpers;

    public function __construct()
    {
    	$this->helpers 	= new SimulationHelpers();
    }

    public function setConfig($config)
    {
    	$this->config = $config;
    }

    public function run(QueueProcess $qp)
    {
        
        $delays = 0;

        if(!$this->config)
            return $delays;

        //see if we are going to delay
        $probability = $this->helpers->getRandomProbability( $this->config['probability']['value'] );

        if(!$probability)
            return $delays;

        //determine the cost
        $cost = $this->helpers->getRandomMinMaxValue($this->config['cost']);

        //determine the reason
        $reason = $this->helpers->getRandomValue($this->config['reason']);

        //log the reason
        $qp->getQueue()->getLogger()->addRecord(
            $qp->get('department'),
            $qp->get('name'), 
            'Finish Delay: ' . $reason, 
            $cost
        );

        //return the cost
        return $cost;

    }


}
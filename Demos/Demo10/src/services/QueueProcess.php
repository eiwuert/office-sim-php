<?php

namespace App\Services;

//use Freshjones\Core\Helpers\SimulationHelpers;
use \FreshJones\Office\Services\Services\ServiceOutputInterface;
use FreshJones\Core\Helpers\Container;

class QueueProcess
{	  

    private $department;
    private $service;
    private $output;
    private $config;
    private $queue;

    public function __construct($department,$service,ServiceOutputInterface $output, $config)
    {
        $this->department = $department;
        $this->service = $service;
        $this->output = $output;
        $this->config = $config;
    }

    private function isDelayed()
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
        $this->queue->log(
            $this->department,
            $this->service, 
            'Finish Delay: ' . $reason, 
            $cost
        );

        //return the cost
        return $cost;
    }

    public function delay_or_process(Queue $queue)
    {

        $this->queue = $queue;

        if( $delay = $this->isDelayed() )
        {
            $this->queue
        }

        
    }

}
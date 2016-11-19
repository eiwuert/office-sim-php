<?php

namespace Simulation\Services;

/* a processor should */
class MarketingProcessor
{
    
    private $params;
    private $status = ['start','processing','finish'];
    private $simulator;

    public function __construct($simulator)
    {
        $this->simulator = $simulator;

        $this->setParam('status','start');
        $this->setParam('delayHours',0);
        $this->setParam('delayCount',0);
        //$this->setParam('delayCountMax',100);

    }

    public function getStatus()
    {
        return $this->params['status'];
    }

    public function getNextStatus()
    {   

        $current = $this->getStatus();
            
        $count = count($this->status);

        $key = array_search($current,$this->status);

        if($key + 1 < $count)
            $key += 1;

        return $this->status[$key];

    }

    public function getSimulator()
    {
        return $this->simulator;
    }

    public function setParam($key,$value)
    {
        $this->params[$key] = $value;
    }

    public function getParam($key)
    {
        return $this->params[$key];
    }

}

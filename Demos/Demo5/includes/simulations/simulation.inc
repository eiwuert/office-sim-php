<?php

/*
    i simulate a services output for a given time period
*/

interface SimulationInterface
{
    public function simulate();
}

class MarketingServiceSimulation implements SimulationInterface
{
    private $leads=0;
    private $logger;
    private $helpers;
    private $data;
   
    public function __construct($data, HelpersInterface $helpers, LoggerInterface $logger)
    {
        $this->logger   = $logger;
        $this->helpers  = $helpers;
        $this->data     = $data;
        $this->sim      = $data['simulation'];
    }

    public function simulate()
    {

        $count = $this->helpers->getRandomMinMaxValue($this->sim['opportunities']);
 
        if(!$count)
            return;

        $this->logger->addRecord('Service', 'Marketing|Opportunities|Attempted', $count);

        for($i=0; $i<$count; $i++)
        {
        
            //determine the probability of converting the opportunity
            if(!$this->helpers->getRandomProbability($this->sim['probability']['value']))
            {
                $this->leads += 1;
                $this->logger->addRecord('Service', 'Marketing|Opportunities|Converted', 1);
            } else {
                $this->logger->addRecord('Service', 'Marketing|Opportunities|Missed', 1);
            }

        }

        echo '<pre>';
        print_r($this->logger);
        echo '</pre>';
        die();

    }

}

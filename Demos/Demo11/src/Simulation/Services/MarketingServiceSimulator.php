<?php

namespace Simulation\Services;

use Simulation\Helpers\SimulationHelpers as Helpers;
use Simulation\Services\MarketingProcessor as Processor;

use Simulation\Contracts\EntityRepository AS EntityRepo;

use Simulation\Models\Entity;

use stdClass;

/* I simulate a marketing service and add lead processes to the simulator queue */
class MarketingServiceSimulator
{
    
    private $queue;
    private $helpers;
    private $logger;
    private $service;
    private $simulation;

    private $entityRepo;

    public function __construct(Logger $logger, Helpers $helpers, Queue $queue, EntityRepo $entityRepo )
    {
        $this->logger = $logger;
        $this->helpers = $helpers;
        $this->queue = $queue;
        $this->entityRepo = $entityRepo;
    }

    //start the simulated process(s)
    public function initialize($service)
    {

        $this->service = $service;
        $this->simulation = $service->simulation;

        $leadCount = $this->getLeadCount();
        
        if(!$leadCount)
            return;
        
        //if we have a lead count we can add them the the simulation queue
        for($i=0;$i<$leadCount;$i++)
        {
            $this->run(new Processor($this));
        }

    }

    public function run($processor)
    {
        $this->{ $processor->getStatus() }($processor);
    }

    private function getProcessorHours($processor,$init=false)
    {
        return $init===true ? $this->helpers->getRandomMinMaxValue( $this->simulation['processtime'] ) : $processor->getParam('delayHours'); 
    }

    private function start($processor)
    {
        $this->processing($processor, true);
    }

    //end the simulated process
    private function processing($processor, $init=false)
    {
      
        $processDelays = $this->getProcessTimeDelays( $processor->getStatus() . 'delays');

        if(!$processDelays  )
        {

            //set the status to processing
            $processor->setParam('status', $processor->getNextStatus() );

            $hours = $this->getProcessorHours($processor, $init);

        } else {

            //we have delays
            $hours = $this->getProcessorHours($processor) + $processDelays;

            $processor->setParam('delayHours', $hours);
            $processor->setParam('delayCount', $processor->getParam('delayCount')  + 1 );

        }

        //register it with the queue
        $this->registerInQueue($hours, $processor);
  
    }

    private function finish($processor)
    {
        $entity = new Entity('lead');
        $this->entityRepo->save($entity);
    }   
    
    private function registerInQueue($hours=0, $processor)
    {
        $this->queue->register
                (
                    $this->getProcessTimeByMonth($hours),
                    $processor 
                );
    } 

    private function getProcessTimeDelays($type='startdelays')
    {    
        return isset($this->simulation[$type]) ? $this->getDelayCost($type) : 0;  
    }

    private function getProcessTimeByMonth($processHours)
    {
        $currentMonth = $this->logger->getTimer()->getCurrentValue('month');  
        return $processHours < 720 ? $currentMonth : $currentMonth + floor($processHours / 720);
    }

    private function getDelayCost($type)
    {
        
        $cost = 0;

        $config = $this->simulation[$type];
     
        if(!$this->helpers->getRandomProbability( $config['probability']['value'] ))
            return $cost;

        $reason = $this->helpers->getRandomValue( $config['reason'] );
        
        $this->logger->addRecord
            ( 
                $this->service->department . ' Delays', 
                ucfirst($type) . ' ' . $this->service->name . ': ' . $reason, 
                'Frequency', 
                1
            );

        $cost = $this->helpers->getRandomMinMaxValue( $config['cost'] );
        
        $this->logger->addRecord
            ( 
                $this->service->department . ' Delays', 
                ucfirst($type) . ' ' . $this->service->name . ': ' . $reason, 
                'Cost in Days', 
                floor($cost/24) 
            );
            
        return $cost;

    }

    private function getLeadCount()
    {

        $leadCount = 0;
        
        $attempts = $this->helpers->getRandomMinMaxValue( $this->simulation['opportunities'] );

        $this->logger->addRecord($this->service->department, $this->service->name, 'Attempted', $attempts);

        if(!$attempts)
            return $leadCount;

        for($i=0;$i<$attempts;$i++)
        {

            if(!$this->helpers->getRandomProbability( $this->simulation['probability']['value'] ) )
            {
                
                $this->logger->addRecord($this->service->department, $this->service->name, 'Missed', 1);

            } else {

                $leadCount += 1;
                $this->logger->addRecord($this->service->department, $this->service->name, 'Converted', 1);
            }
        }

        return $leadCount;

    }

}

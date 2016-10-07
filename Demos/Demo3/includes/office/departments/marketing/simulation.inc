<?php

//use ServiceSimulations\ServiceSimulation as ServiceSimulation;

/* 
    Each service must run through a ServiceSimulation class 
    whose objective it is to simulate how the service would 
    statistically react in actuality

    the goal of each ServiceSimulation class is to: 
    1) Generate outputs (backlog objects) for this instance of the service that represent work completed (service outputs)
    2) Generate statistical data for this instance of the service
    3) Return this data for use by the department service object
*/

class MarketingSimulation extends ServiceSimulation
{

  private $leads = 0;

  //set the opportunities available
  public function simulate()
  {

echo '<pre>';
print_r('yup');
echo '</pre>';
die();
      $count = $this->helpers->getRandomMinMaxValue($this->config['opportunities']);
   
      if(!$count)
        return;

      $this->logger->addRecord($this->department, $this->service, 'Opportunities|Attempted', $count);

      for($i=0; $i<$count; $i++)
      {
          
          //determine the probability of converting the opportunity
          if(!$this->getProbability( $this->getConfigValue('probability') ))
          {
            $this->leads += 1;
            $this->logger->addRecord($this->department, $this->service, 'Opportunities|Converted', 1);
          } else {
            $this->logger->addRecord($this->department, $this->service, 'Opportunities|Missed', 1);
          }

      }

  }
 
  public function setProcesses()
  {

    /*
      if we have any conversions we can create a process object for them
      each of these will then be added to the backlog
    */
    if( $outputs = $this->leads )
    {

      /*
      $processClassName = $this->config['classes']['processClass']['value'];

      for($i=0; $i<$hits; $i++)
      {

        $processClass = new $processClassName();
        $processClass->setProcess($this);
        $process = $processClass->getProcess();

      }
      */

      for($i=0; $i<$outputs; $i++)
      {
        $process = new stdClass();
        $process->name = 'Create a Lead Process';
        $process->class = 'LeadServices';
        $process->method = 'createLead';
        $process->params = array();

        $this->logger->addRecord($this->department, $this->service, 'Process|Leads Created', 1);
        $this->backlog->addBacklogObject($process);

      }

    }

  }

}


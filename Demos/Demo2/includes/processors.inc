<?php

interface ProcessorInterface
{
    public function setProcess($obj);
    public function getProcess();
}


abstract class Processor implements ProcessorInterface
{
    protected $process;

    public function getProcess()
    {
        return $this->process;
    }

}


/*  */
class LeadProcessor extends Processor
{
 
    public function setProcess($simulation)
    {

        $helpers = $simulation->getHelpers();
        $config = $simulation->getConfig();

        $processObj = new stdClass();

        $processObj->name = "Create a lead process";
        $processObj->time = $helpers->getRandomMinMaxValue($config['processtime']);
        $processObj->class = 'Lead';
        $processObj->method = 'createLead';
        $processObj->status = 'Active';
        $processObj->params = array();

        $this->process = $processObj;
    }

    

}
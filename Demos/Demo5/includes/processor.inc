<?php

/* create and return a process object */

interface ProcessorService
{

}

class BasicProcessor implements ProcessorService
{
	
	private $process;
	private $params;

	public function __construct()
	{
		$this->setProcess();
	}

	public function setParam($param,$value)
	{
		$this->params[$param] = $value;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function setProcess()
	{
		$processObj = new stdClass();

		if($this->getParams())
		{
			foreach($this->getParams() AS $k => $v)
			{
				$processObj->{$k} = $v;
			}
		}

	    $this->process = $processObj;
	}

	public function getProcess()
	{
		return $this->process;
	}
	
}
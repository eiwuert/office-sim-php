<?php

namespace FreshJones\Office\Services\Services;

use Freshjones\Core\Helpers\Container;

class ServiceOutputContainer extends Container
{

	public function __construct($config)
	{
		$this->set('config',$config);

		$this->setOutputs();
	}

	private function setOutputs()
	{

		$outputs = array();

		foreach($this->get('config') AS $key => $output)
		{
			$outputs[] = new ServiceOutput($key);
		}

		$this->set('outputs',$outputs);

	}

	public function getOutputs()
	{
		return $this->get('outputs');
	}
	
}
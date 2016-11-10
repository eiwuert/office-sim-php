<?php

namespace FreshJones\Office\Services\Services;

use Freshjones\Core\Helpers\Container;

class ServiceContainer extends Container
{

	public function __construct($data)
	{
		
		if(isset($data['services']) && !empty($data['services']))
		{
			$this->setServices($data['services']);
		}
		
	}

	private function setServices($serviceData)
	{

		foreach($serviceData AS $key => $servicedata)
		{

			if(!isset($servicedata['class']))
				continue;

			$simulationData = $servicedata['simulation'];
			$simulatorName = $simulationData['classes']['simulationClass']['value'];
			$simulator = new $simulatorName($simulationData);

			$this->addService($key, new $servicedata['class']($servicedata, $simulator) );

		}

	}

	private function addService($key,ServiceInterface $service)
	{
		$this->set($key,$service);
	}

}
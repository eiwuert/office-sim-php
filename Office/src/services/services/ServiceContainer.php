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

	private function setServices($serviceDataArray)
	{
		
		foreach($serviceDataArray AS $key => $serviceData)
		{

			if(!isset($serviceData['class']))
				continue;

			$simulationData = $serviceData['simulation'];
			
			$service = new $serviceData['class']($serviceData);

			//set the simulator
			$simulatorName = $simulationData['classes']['simulationClass']['value'];

			$service->setSimulator( new $simulatorName($simulationData) );
			
			//set the outputs
			$serviceOutputs = new ServiceOutputContainer( $serviceData['outputs'] );
			$service->setOutputs($serviceOutputs);

			//add the service
			$this->addService($key, $service);

		}

	}

	private function addService($key,ServiceInterface $service)
	{
		$this->set($key,$service);
	}

}
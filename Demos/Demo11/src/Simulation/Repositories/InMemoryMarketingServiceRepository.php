<?php

namespace Simulation\Repositories;

use Simulation\Contracts\MarketingServiceRepository;

use Simulation\Models\MarketingService;

class InMemoryMarketingServiceRepository implements MarketingServiceRepository
{
    
    private $services;

    public function __construct()
    {

		$services = require(__DIR__ . '/../Data/marketing.php');

		foreach($services AS $key => $config)
		{
			$this->services[$key] = new MarketingService($config);
		}
		
    }

    public function all()
    {
    	return $this->services;
    }
   
}

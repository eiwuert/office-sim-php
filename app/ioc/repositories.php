<?php

use Simulation\Contracts\MarketingServiceRepository;
use Simulation\Repositories\InMemoryMarketingServiceRepository;

$repos = array();

$repos[MarketingServiceRepository::class] = DI\object(InMemoryMarketingServiceRepository::class)
	->constructor(
     	DI\get('marketing.config')
    );

return $repos;
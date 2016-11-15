<?php

namespace FreshJones\Office\Services\Services;

use FreshJones\Office\Contracts\ServiceOutputContract;

class SimulationServiceOutput implements ServiceOutputContract
{

	public function __construct(){}

	/* what should this do? */
	/* in reality maybe it persists something to the db that states the output is completed? */
	/* or it triggers another process? */
	/* or it marks this instance of the service complete? */
	/* or it adds something to another processes queue */
	public function run()
	{
		
	}

}

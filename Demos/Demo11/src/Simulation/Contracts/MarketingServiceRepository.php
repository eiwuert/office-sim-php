<?php

namespace Simulation\Contracts;

/**
 * This is an interface so that the model is coupled to a specific backend.
 */

interface MarketingServiceRepository
{

	/**
     * @return Service[]
     */
    public function all();

}
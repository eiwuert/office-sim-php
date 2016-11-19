<?php

namespace Simulation\Contracts;

/**
 * This is an interface so that the model is coupled to a specific backend.
 */

interface EntityRepository
{

	/**
     * @return Service[]
     */
    public function all();

    public function get($type);

    public function save($entity);
    
}
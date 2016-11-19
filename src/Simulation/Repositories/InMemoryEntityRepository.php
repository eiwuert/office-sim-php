<?php

namespace Simulation\Repositories;

use Simulation\Contracts\EntityRepository;


class InMemoryEntityRepository implements EntityRepository
{
    
    private $services;
    private $entities;

    public function __construct()
    {
		$this->services = require(__DIR__ . '/../Data/sales.php');
    }

    public function get($type)
    {
        $entities = array();

        if(empty($this->entities))
            return false;

        foreach($this->entities AS $entity)
        {
            if($entity->type == $type)
            {
                $entities[] = $entity;
            }
        }

        return $entities;
    }

    public function all()
    {
    	return $this->entities;
    }

    public function save($entity)
    {
        if(!isset($this->services[$entity->type]))
            return;
        
        $entity->setConfig( $this->services[$entity->type] );
        $this->entities[] = $entity;
    }
   
}

<?php

interface RegistryInterface
{

}

class Registry implements RegistryInterface
{
    private $registry;

    public function set($name)
    {
    	
        $this->registry[] = $name;
    }

    public function get()
    {
        return $this->registry;
    }

}

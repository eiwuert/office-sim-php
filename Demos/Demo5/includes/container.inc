<?php

class Container
{
    private $container;

    public function set($name,$obj)
    {
        $this->container[$name] = $obj;
    }

    public function get($name)
    {
        return $this->container[$name];
    }

}

<?php

namespace Core;

class Collection
{
    
    private $collection;

    public function __construct()
    {
    }

    public function set($obj)
    {
        $this->collection[] = $obj;
    }

    public function get($key)
    {
        return $this->collection[$key];
    }

    public function all()
    {
        return $this->collection;
    }

}
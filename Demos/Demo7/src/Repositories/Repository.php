<?php 

namespace App\Repositories;

use \Exception;
use App\Contracts\RepositoryInterface;
use App\Support\Container;
use App\Models\Model;

abstract class Repository implements RepositoryInterface 
{
    protected $app;
    protected $model;

    public function __construct(Container $app) 
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    public function makeModel() 
    {   

        $model = $this->app[$this->model()];
    
        if (!$model instanceof Model)
            throw new Exception("Class {$this->model()} must be an instance of App\Models\Model");
 
        return $this->model = $model;
    }
    
    public function all() {
        return $this->model->get();
    }

}
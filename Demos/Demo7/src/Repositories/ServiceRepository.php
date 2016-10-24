<?php 

namespace App\Repositories;

class ServiceRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Service';
    }
    
}
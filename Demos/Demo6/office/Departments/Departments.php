<?php

namespace App\Departments;

use App\Includes\Collection;
use App\Contracts\Departments\DepartmentsInterface;
use App\Contracts\Departments\DepartmentInterface;

class Departments implements DepartmentsInterface
{
    private $departments;

    public function __construct(){}

    public function setDepartment(DepartmentInterface $department)
    {
        $this->departments[] = $department;
    }

    public function getDepartment($name)
    {
        return $this->departments[$name];
    }

    public function getAll()
    {
        return $this->departments;
    }

}

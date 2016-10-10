<?php

namespace App\Includes\Departments;

interface DepartmentsInterface
{
    public function setDepartment(DepartmentInterface $department);
    public function getDepartment($name);
    public function getAll();
}

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

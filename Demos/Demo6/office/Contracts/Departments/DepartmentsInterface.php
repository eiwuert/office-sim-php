<?php

namespace App\Contracts\Departments;

use App\Contracts\Departments\DepartmentInterface;

interface DepartmentsInterface
{
    public function setDepartment(DepartmentInterface $department);
    public function getDepartment($name);
    public function getAll();
}

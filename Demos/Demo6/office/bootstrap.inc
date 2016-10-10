<?php

require_once(__DIR__ . '/includes/departments/marketing/bootstrap.php');
require_once(__DIR__ . '/includes/simulation/bootstrap.php');

use App\Includes\Departments\Departments;
use App\Includes\Persons;
use App\Includes\Office;

$departments = new Departments();
$departments->setDepartment($marketing);

$persons = new Persons();
$office = new Office($departments, $persons, $simulation);
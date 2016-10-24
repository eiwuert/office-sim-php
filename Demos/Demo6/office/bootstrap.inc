<?php

require_once(__DIR__ . '/departments/marketing/bootstrap.php');
require_once(__DIR__ . '/simulation/bootstrap.php');

use App\Departments\Departments;
use App\Includes\Persons;
use App\Includes\Office;

$departments = new Departments();
$departments->setDepartment($marketing);

$persons = new Persons();
$office = new Office($departments, $persons, $simulation);
<?php

use Core\App;
use Core\Collection;
use Core\Database\QueryBuilder;
use Core\Database\Connection;

use Office\Departments\Marketing;
use Office\Departments\Sales;
use Office\Departments\Operations;
use Office\Departments\Customer;

$departments = new Collection();
$departments->set( new Marketing() );
$departments->set( new Sales() );
$departments->set( new Operations() );
$departments->set( new Customer() );

App::bind('departments', $departments);

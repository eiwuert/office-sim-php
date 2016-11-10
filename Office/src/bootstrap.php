<?php

require __DIR__ . '/../vendor/autoload.php';

use Freshjones\Core\Helpers\Container;

use FreshJones\Office\Services\Departments\Marketing;
use FreshJones\Office\Services\Departments\Sales;
use FreshJones\Office\Services\Departments\Customer;

use FreshJones\Office\Services\Services\OfficeContainer;
use FreshJones\Office\Services\Services\ServiceContainer;

$marketing = new Marketing('marketing');
$marketing->setServices( new ServiceContainer(require 'data/marketing.php') );

$sales = new Sales('sales');
$sales->setServices( new ServiceContainer(require 'data/sales.php') );

$customer = new Customer('customer');
$customer->setServices( new ServiceContainer(require 'data/customer.php') );

$departments = new Container();
$departments->set('marketing', $marketing);
$departments->set('sales', $sales);
$departments->set('customer', $customer);

$office = new OfficeContainer();
$office->set('departments', $departments);


<?php

require_once(__DIR__ . '/../vendor/autoload.php'); 

use App\Support\Container;
use App\Repositories\ServiceRepository as Service;

use App\Models\Service as ServiceModel;

$app = new Container();

$app['App\Models\Service'] = $app->share(function ($c) 
{
	return new ServiceModel();
});

$service = new Service($app);


echo '<pre>';
print_r( $service) );
echo '</pre>';
die();


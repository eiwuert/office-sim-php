<?php

use Freshjones\Core\Helpers\Container;

use App\Services\Timer;
use App\Services\Logger;
use App\Services\Queue;
use App\Services\Statistics;
use App\Services\Simulation;

require __DIR__ . '/../vendor/autoload.php';

$app = new Container();

$app->set('config',require 'config.php');
$app->set('timer',new Timer());
$app->set('logger',new Logger($app->get('timer')));
$app->set('queue',new Queue($app->get('logger')));
$app->set('statistics',new Statistics($app->get('logger')));

$office = require __DIR__ . '/../../../Office/src/bootstrap.php';

$app->set('office',$office);

$app->set('simulation',new Simulation($app));


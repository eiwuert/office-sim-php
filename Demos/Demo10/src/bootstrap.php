<?php

use Freshjones\Core\Helpers\Container;

use App\Services\Timer;
use App\Services\Logger;
use App\Services\Queue;
use App\Services\Simulation;
use App\Services\Statistics;

use App\Services\MarketingQueueProcessor;


require __DIR__ . '/../vendor/autoload.php';


$app = new Container();

$app->set('config',require 'config.php');
$app->set('timer',new Timer());
$app->set('logger',new Logger($app->get('timer')));
$app->set('queue',new Queue($app->get('timer')));

$queueProcessors = new Container();
$queueProcessors->set('marketing', new MarketingQueueProcessor($app->get('timer')) );
$app->set('queueprocessors',$queueProcessors);

$app->set('office',$office);

$app->set('statistics',new Statistics($app->get('logger')));

$app->set('simulation',new Simulation($app));

$simulation = $app->get('simulation');


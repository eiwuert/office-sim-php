<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\App;
use Core\Database\QueryBuilder;
use Core\Database\Connection;
use App\Services\Timer;
use App\Services\Simulation;

App::bind('config', require '../config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

App::bind('timer', new Timer());

App::bind('simulation', new Simulation(App::get('timer')));
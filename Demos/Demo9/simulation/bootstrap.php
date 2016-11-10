<?php

use Core\App;
use Simulation\Services\Timer;
use Simulation\Services\Queue;
use Simulation\Services\Logger;
use Simulation\Services\Simulation;

//$office = require __DIR__ . '/../office/index.php';

//App::bind('office', $office);

App::bind('timer', new Timer());
App::bind('queue', new Queue());
App::bind('logger', new Logger());
App::bind('simulation', new Simulation());


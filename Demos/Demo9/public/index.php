<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../core/bootstrap.php';

require __DIR__ . '/../office/bootstrap.php';

require __DIR__ . '/../simulation/bootstrap.php';

use Core\Router;
use Core\Request;

Router::load('../simulation/routes.php')
    ->direct(Request::uri(), Request::method());
    
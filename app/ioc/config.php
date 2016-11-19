<?php

$data           = require __DIR__ . '/data.php';
$env            = require __DIR__ . '/env.php';
$helpers        = require __DIR__ . '/helpers.php';
$factories       = require __DIR__ . '/factories.php';
$services       = require __DIR__ . '/services.php';
$repositories    = require __DIR__ . '/repositories.php';
$controllers    = require __DIR__ . '/controllers.php';

return array_merge($data, $env, $helpers,  $repositories, $factories, $services, $controllers);
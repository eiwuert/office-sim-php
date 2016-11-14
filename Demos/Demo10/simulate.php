<?php

require __DIR__ . '/src/bootstrap.php';

$simulation = $app->get('simulation');

$simulation->run();

echo $simulation->statistics();

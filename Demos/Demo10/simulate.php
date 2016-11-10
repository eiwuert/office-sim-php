<?php

require __DIR__ . '/../../Office/src/bootstrap.php';
require __DIR__ . '/src/bootstrap.php';

$simulation->run();

echo $simulation->statistics();
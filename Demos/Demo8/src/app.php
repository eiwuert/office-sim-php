<?php

$config = require_once(__DIR__ . '/configuration.php');


echo '<pre>';
print_r($config);
echo '</pre>';
die();
/* in order to bootstrap we need */

/*
1) load in our config data
2) models that know how to read the config data through a connector?
3) have a repo interface so we can interact with our model generically??
4) ioc container so that any of the above can be swapped in/out
*/






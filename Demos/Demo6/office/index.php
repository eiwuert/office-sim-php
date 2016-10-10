<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/bootstrap.inc');



echo '<pre>';
print_r($office->simulate());
echo '</pre>';
die();
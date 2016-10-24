<?php

//require_once(__DIR__ . '/includes/pimple.inc');
require_once(__DIR__ . '/office/index.php');

echo '<pre>';
print_r($office->simulate());
echo '</pre>';
die();
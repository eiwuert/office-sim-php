<?php

/**
 * The bootstrap file creates and returns the container.
 */
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

//$container = DI\ContainerBuilder::buildDevContainer();

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(require __DIR__ . '/config.php');

$builder->useAutowiring(false);
$builder->useAnnotations(false);

$container = $builder->build();

return $container;
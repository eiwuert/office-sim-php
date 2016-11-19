<?php

$env = array();

$env[Twig_Environment::class] = function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../src/Simulation/Views');
        return new Twig_Environment($loader);
};

return $env;
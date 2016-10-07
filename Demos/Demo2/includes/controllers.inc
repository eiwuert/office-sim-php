<?php

use Pimple\Container as Container;

abstract class Controller
{

   protected $app;
   protected $service;

   public function __construct(Container $container) {
      $this->app = $container['app'];
      $this->init($container);
   }

   public abstract function init(Container $container);

}

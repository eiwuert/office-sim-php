<?php
namespace Simulation\Controller;

use Twig_Environment;

class HomeController
{
   
   	private $twig;
    
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        echo $this->twig->render('home.twig');
    }
    
}
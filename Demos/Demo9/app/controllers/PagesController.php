<?php

namespace App\Controllers;

use Core\App;

class PagesController
{
    /**
     * Show the home page.
     */
    public function home()
    {
        return view('index');
    }
    
    public function simulate()
    {   
        $simulation = App::get('simulation');
        $simulation->run();
        $stats = $simulation->statistics();
        return view('simulate', compact('stats'));
    }

}

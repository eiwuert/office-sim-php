<?php

//namespace BacklogServices;

//use Singleton\Singleton as Singleton;

class Backlog
{
    private $backlog;

    public function addBacklogObject($obj)
    {
        if(!is_array($this->backlog))
            $this->backlog = array();

        $this->backlog[] = $obj;
    }

    public function getBacklog()
    {
        return $this->backlog;
    }

    public function run()
    {
        echo '<pre>';
        print_r('run processor');
        echo '</pre>';
    }

}

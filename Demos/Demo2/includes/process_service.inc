<?php

namespace ProcessServices;

class ProcessService
{
    private $processes;

    public function addProcess($obj)
    {
        $processes[] = $obj;
    }

    public function getProcesses()
    {
        return $this->processes;
    }

    public function run()
    {
        echo '<pre>';
        print_r('run processor');
        echo '</pre>';
    }

}

<?php

namespace Simulation\Services;

use Core\App;

class Logger
{
    
    private $timer;
    private $log = array();

    public function __construct()
    {
        $this->timer = App::get('timer');
    }

    public function addRecord($type,$id,$value)
    {   

        $iteration = $this->timer->getCurrentValue('iteration');
        $year = $this->timer->getCurrentValue('year');
        $month = $this->timer->getCurrentValue('month');
        $day = $this->timer->getCurrentValue('day');
        $hour = $this->timer->getCurrentValue('hour');

        $key = $month . '-' . $day . '-' . $hour;
        $record['type'] = $type;
        $record['id'] = $id;
        $record['value'] = $value;
        $record['iteration'] = $iteration;
        $record['year'] = $year;
        $record['month'] = $month;
        $record['day'] = $day;
        $record['hour'] = $hour;
        $this->log[] = $record;
    }

    public function getRecord($id)
    {
        return $this->log[$id];
    }

    public function setLog($id)
    {
        return $this->log = array();
    }

    public function getLog()
    {
        return $this->log;
    }

}
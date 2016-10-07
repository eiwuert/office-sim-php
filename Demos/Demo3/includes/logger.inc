<?php

interface LoggerInterface
{

}

class StdLogger implements LoggerInterface
{
    public function __construct(TimerService $timer)
    {
        $this->timer = $timer;
    }
}
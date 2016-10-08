<?php

interface ServiceInterface
{
    public function simulate();
}

class MarketingService implements ServiceInterface
{
    private $data;
    private $backlog;

    public function __construct($data, BacklogInterface $backlog)
    {
        $this->data     = $data;
        $this->backlog  = $backlog;
    }

    public function simulate()
    {
        $sim = $this->data['simulation'];

        echo '<pre>';
        print_r($sim);
        echo '</pre>';
        die();
    }
}

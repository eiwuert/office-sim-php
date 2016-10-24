<?php

namespace App\Includes;

use App\Contracts\People\PersonsInterface;
use App\Contracts\People\PersonInterface;

class Persons implements PersonsInterface
{
    private $persons;

    public function __construct()
    {
        
    }

    public function setPerson(PersonInterface $person)
    {
        $this->persons[] = $person;
    }

    public function getPerson($person)
    {
        return $this->persons[$person];
    }

}

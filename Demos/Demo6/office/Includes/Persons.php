<?php

namespace App\Includes;

interface PersonsInterface
{
    public function setPerson(PersonInterface $person);
    public function getPerson(String $person);
}

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

    public function getPerson(String $person)
    {
        return $this->persons[$person];
    }

}

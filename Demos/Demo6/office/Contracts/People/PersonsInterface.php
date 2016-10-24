<?php

namespace App\Contracts\People;

use App\Contracts\People\PersonInterface;

interface PersonsInterface
{
    public function setPerson(PersonInterface $person);
    public function getPerson($person);
}


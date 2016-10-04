<?php

class ProspectLead extends Prospect implements ProspectInterface
{

    public function qualifyProspect()
    {
        $contact = $this->contact->getContact();
        return $contact->status == 'Qualified' ? true : false;
    }

}
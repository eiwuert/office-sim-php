<?php


class ProspectCustomer extends Prospect implements ProspectInterface
{

    public function qualifyProspect()
    {
        $contact = $this->contact->getContact();
        return $contact->status == 'Active' ? true : false;
    }

}


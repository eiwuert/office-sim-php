<?php


class Contact
{

  private $contact;

  public function __construct($contact)
  {
    $this->setContact($contact);
  }

  public function setContact($contact)
  {
    $this->contact = $contact;
  }

  public function getContact()
  {
    return $this->contact;
  }

  public function getType()
  {
    return $this->contact->type;
  }

}
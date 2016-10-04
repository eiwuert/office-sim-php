<?php

interface ProspectInterface
{

	function qualifyProspect();

}

abstract class Prospect implements ProspectInterface
{
   	
   	protected $contact;

	public function __construct(Contact $contact)
    {
    	$this->contact = $contact; 
   	}

   	abstract function qualifyProspect();

}
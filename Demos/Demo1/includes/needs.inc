<?php

class NeedsAssessment
{
    private $prospect;

  	public function __construct(Prospect $prospect)
    {

      $this->prospect = $prospect;

      if(!$this->qualifyProspect())
      {
      
        echo 'Not a valid prospect sorry';
      
      } else {

         echo 'Valid prospect yay!';

      }

   	}

    private function qualifyProspect()
    {

      return $this->prospect->qualifyProspect();

    }
}

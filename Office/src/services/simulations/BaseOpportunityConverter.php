<?php

namespace FreshJones\Office\Services\Simulations;

interface OpportunityConverterInterface {

}

/* converts opportunties to outputs */
class BaseOpportunityConverter implements OpportunityConverterInterface
{
	
	private $helpers;
	private $opportunities;
	private $probability;

	public function __construct($helpers)
	{
		$this->helpers 			= $helpers;
	}

	public function setOpportunities( $opportunities=array() )
	{
		$this->opportunities['values'] = isset($opportunities['values']) && is_array($opportunities['values']) ? $opportunities['values'] : [[0,0]];
		$this->opportunities['weights'] = isset($opportunities['weights']) && is_array($opportunities['weights']) ? $opportunities['weights'] : [100];
	}

	public function setProbability($probability)
	{
		$this->probability = isset($probability['value']) && is_int($probability['value']) ? $probability['value'] : 0;
	}
	
	public function convert($department,$service,$logger)
	{

		$opportunities = 0;

		$attempts = $this->helpers->getRandomMinMaxValue($this->opportunities);

		$logger->addRecord($department, $service, 'Attempted', $attempts);

		if(!$attempts)
			return $opportunities;

		for($i=0;$i<$attempts;$i++)
		{
			if(!$this->helpers->getRandomProbability( $this->probability ) )
			{
				
				$logger->addRecord($department, $service, 'Missed', 1);

			} else {

				$opportunities += 1;
				$logger->addRecord($department, $service, 'Converted', 1);
			}
		}

		return $opportunities;

	}

}
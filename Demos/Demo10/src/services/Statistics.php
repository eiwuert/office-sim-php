<?php

namespace App\Services;

class Statistics
{	
	private $logger;
	private $data;

	public function __construct(Logger $logger)
	{
		$this->logger = $logger;
	}

	public function set()
	{	

		$log = $this->logger->getLog();

		foreach($log AS $item)
		{

			if( !isset($this->data[ $item['department'] ]['cumulative'][ $item['service'] ][ $item['id'] ] ) )
				$this->data[ $item['department'] ]['cumulative'][ $item['service'] ][ $item['id'] ] = 0;

			$this->data[ $item['department'] ]['cumulative'][ $item['service'] ][ $item['id'] ] += $item['value'];


			if( !isset($this->data[ $item['department'] ]['monthly'][ $item['month'] ][ $item['service'] ][ $item['id'] ] ) )
				$this->data[ $item['department'] ]['monthly'][ $item['month'] ][ $item['service'] ][ $item['id'] ] = 0;

			$this->data[ $item['department'] ]['monthly'][ $item['month'] ][ $item['service'] ][ $item['id'] ] += $item['value'];
			
		}

	}

	private function getMonth($value)
	{
		switch($value)
		{
			case 1:
				return 'January';
			break;

			case 2:
				return 'February';
			break;

			case 3:
				return 'March';
			break;

			case 4:
				return 'April';
			break;

			case 5:
				return 'May';
			break;

			case 6:
				return 'June';
			break;

			case 7:
				return 'July';
			break;

			case 8:
				return 'August';
			break;

			case 9:
				return 'September';
			break;

			case 10:
				return 'October';
			break;

			case 11:
				return 'November';
			break;

			case 12:
				return 'December';
			break;

		}
	}
	
	private function getColor()
	{	
		$hex = '#';
 
		//Create a loop.
		foreach(array('r', 'g', 'b') as $color){
		    //Random number between 0 and 255.
		    $val = mt_rand(0, 255);
		    //Convert the random number into a Hex value.
		    $dechex = dechex($val);
		    //Pad with a 0 if length is less than 2.
		    if(strlen($dechex) < 2){
		        $dechex = "0" . $dechex;
		    }
		    //Concatenate
		    $hex .= $dechex;
		}
		 
		//Print out our random hex color.
		return $hex;

	}

	private function getMarketingData($data)
	{
		$formatted = array();

		$count = 0;
		foreach( $data['cumulative'] AS $cK => $cV )
		{
			
			if(!isset($cV['Converted']))
				continue;

			$formatted['cumulative']['labels'][$count] = $cK;
			$formatted['cumulative']['datasets'][0]['data'][$count] = $cV['Converted'];
			$formatted['cumulative']['datasets'][0]['backgroundColor'][$count] = $this->getColor();
			$count++;
		}

		foreach( $data['cumulative'] AS $serviceKey => $serviceIDs )
		{

			$hit = isset($serviceIDs['Converted']) ? round( ($serviceIDs['Converted'] /  $serviceIDs['Attempted']) * 100, 2) : 0;
			$miss = isset($serviceIDs['Missed']) ? round( ($serviceIDs['Missed'] /  $serviceIDs['Attempted']) * 100, 2) : 0;
			$formatted['hitmiss'][str_replace(' ', '', $serviceKey)]['labels'] = array('Hit','Miss');
			$formatted['hitmiss'][str_replace(' ', '', $serviceKey)]['datasets'][0]['backgroundColor'] = array($this->getColor(),$this->getColor());
			$formatted['hitmiss'][str_replace(' ', '', $serviceKey)]['datasets'][0]['data'] = array($hit,$miss);
	
		}

		$monthlyDataSets = array_keys($data['cumulative']);
		
		for($i=1;$i<=12;$i++)
		{
			$formatted['monthly']['labels'][] = $this->getMonth($i);	
		}

		foreach($monthlyDataSets AS $label)
		{

			$monthlyData = array();
			$monthlyData[$label] = array();

			for($i=0;$i<12;$i++)
			{
				$monthlyData[$label][$i] = 0;

				if(isset($data['monthly'][$i+1][$label]) && isset($data['monthly'][$i+1][$label]['Converted']) )
				{
					$monthlyData[$label][$i] = $data['monthly'][$i+1][$label]['Converted'];
				}
				
			}

			$formatted['monthly']['datasets'][] = array(

				"label" => $label,
				"backgroundColor" => $this->getColor(),
				"data" => $monthlyData[$label]
			);

		}

		return $formatted;
	
	}


	private function getMarketingDelays($data)
	{
		$formatted = array();

		
		$count = 0;
		foreach( $data['cumulative'] AS $cK => $cV )
		{
			
			if(!isset($cV['Frequency']))
				continue;

			$formatted['cumulative']['frequency']['labels'][$count] = $cK;
			$formatted['cumulative']['frequency']['datasets'][0]['data'][$count] = $cV['Frequency'];
			$formatted['cumulative']['frequency']['datasets'][0]['backgroundColor'][$count] = $this->getColor();

			$formatted['cumulative']['cost']['labels'][$count] = $cK;
			$formatted['cumulative']['cost']['datasets'][0]['data'][$count] = $cV['Cost in Days'];
			$formatted['cumulative']['cost']['datasets'][0]['backgroundColor'][$count] = $this->getColor();

			$count++;
		}


		$monthlyDataSets = array_keys($data['cumulative']);
		
		for($i=1;$i<=12;$i++)
		{
			$formatted['monthly']['labels'][] = $this->getMonth($i);	
		}

		foreach($monthlyDataSets AS $label)
		{

			$monthlyData = array();
			$monthlyData[$label] = array();

			for($i=0;$i<12;$i++)
			{
				$monthlyData[$label][$i] = 0;

				if(isset($data['monthly'][$i+1][$label]) && isset($data['monthly'][$i+1][$label]['Frequency']) )
				{
					$monthlyData[$label][$i] = $data['monthly'][$i+1][$label]['Frequency'];
				}
				
			}

			$formatted['monthly']['datasets'][] = array(

				"label" => $label,
				"backgroundColor" => $this->getColor(),
				"data" => $monthlyData[$label]
			);

		}

		return $formatted;
	
	}

	public function get()
	{

		if(!$this->data)
			return;
		
		$formatted = array();

		if(isset($this->data['Marketing']))
		{
			$formatted['Marketing'] = $this->getMarketingData($this->data['Marketing']);
		}
		
		if(isset($this->data['Marketing Delays']))
		{
			$formatted['Delays']['Marketing'] = $this->getMarketingDelays($this->data['Marketing Delays']);
		}

		return json_encode($formatted);

	}
    
}
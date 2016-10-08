<?php 

//namespace Helpers;
interface HelpersInterface
{

}

class Helpers implements HelpersInterface
{

	public function getRandomProbability($val)
    { 
    	$r = rand(1,100);
    	return $r <= $val;
    }

    public function random($min,$max,$floor=false)
    {
    	$val = rand($min,$max);
        if($floor === true) $val = floor($val);
        return $val;
    }

     public function getRandomValue($data) 
    {	

    	$values = $data['values'];
    	$weights = $data['weights'];

		$total_weight = array_sum($weights);

        $random_num = $this->random(0, $total_weight);

        $weight_sum = 0;
        
        for ($i=0; $i < count($values); $i++) {
            $weight_sum += $weights[$i];
            $weight_sum = number_format($weight_sum,2);
            if ($random_num <= $weight_sum) {
                return $values[$i];
            }
        }
        
    }

    public function getRandomMinMaxValue($data) 
    {

    	$ranges = $data['values'];
    	$weights = $data['weights'];

        if(!is_array($ranges) || !is_array($weights)) return 0;

        $range = $this->getRandomValue($data);

        $value = $this->random($range[0],$range[1],true);

        return $value;
    }

    public function getValueByRangeOption($val, $obj) 
    {
        for ($i=0; $i < count($obj['options']); $i++) {
            if($val >= $obj['options'][$i][0] && $val <= $obj['options'][$i][1])
            {
                return $obj['values'][$i];
            }
        }
    }

    public function capitalize($s)
    {
        return strtoupper($s);
    }

    public function uuid()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	        // 32 bits for "time_low"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

	        // 16 bits for "time_mid"
	        mt_rand( 0, 0xffff ),

	        // 16 bits for "time_hi_and_version",
	        // four most significant bits holds version number 4
	        mt_rand( 0, 0x0fff ) | 0x4000,

	        // 16 bits, 8 bits for "clk_seq_hi_res",
	        // 8 bits for "clk_seq_low",
	        // two most significant bits holds zero and one for variant DCE1.1
	        mt_rand( 0, 0x3fff ) | 0x8000,

	        // 48 bits for "node"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    	);
    }

}


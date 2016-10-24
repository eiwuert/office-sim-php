<?php
return [
	"database" => [
		"directory" => "data",
	],
	"similation" => [
		"iterations"=>1,
		"jobsPerYear"=>1,
		"daysPerYear"=>360,
		"ratePerHour"=>100,
		"workingHours" => [8,9,10,11,12,13,14,15],
		"net_terms" => [30,60,90],
		"invoice_terms" => [0,30],
		"starting_balance" => 0,
		"rush_probabilty" => 25,
		"chargeby" => "Resource",
	]
];
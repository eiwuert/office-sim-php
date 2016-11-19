<?php
return [

	"referall" => [
		"name" => "Referall",
		"department" => "Marketing",
		"inputs" => [],
		"outputs" => [],
		"processes" => [],
		"simulation" => [
			"opportunities" => [ 
				"values"=> [[0,3],[4,6],[7,10],[11,15]],
				"weights"=> [30,57,10,3],
				"description"=> "weighted amount of outputs this service can produce in a given time period per team member"
			],
			"probability" => [ 
				"value"=> 50, 
				"description"=> "percent probability of converting an input to an output"
			],
			"processtime" => [ 
				"values"=> [[24,48],[48,72],[72,168],[168,720]],
				"weights"=> [30,50,15,5],
				"description"=> "weighted amount of hours necessary to fullfill the services processes"
			],
			"startdelays" => [
				"probability" => [
					"value" => 50,
					"description" => "probability that this service will be delayed in starting"
				],
				"cost" => [
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [30,50,15,5],
					"description" => "weighted amount of time added to the start date of the service"
				],
				"reason" => [
					"values" => [
						"Customer delays getting requirements to us",
						"Customer delays signing contract",
						"Customer delays initial payment"
					],
					"weights" => [70,10,20],
					"description" => "weighted reasons why the start delay occured beyond its normal input requirements"
				]
			],
			"finishdelays" => [
				"probability" => [
					"value" => 50,
					"description" => "probability that this service will be delayed in finishing"
				],
				"cost" => [
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [30,50,15,5],
					"description" => "weighted amount of time added to the start date of the service"
				],
				"reason" => [
					"values" => [
						"Customer delays getting requirements to us",
						"Customer delays signing contract",
						"Customer delays initial payment"
					],
					"weights" => [70,10,20],
					"description" => "weighted reasons why the finish delay occured"
				],
			],
		],
	],
	"advertisment" => [
		"name" => "Advertisment",
		"department" => "Marketing",
		"inputs" => [],
		"outputs" => [],
		"processes" => [],
		"simulation" => [
			"opportunities" => [ 
				"values"=> [[0,3],[4,6],[7,10],[11,15]],
				"weights"=> [30,57,10,3],
				"description"=> "weighted amount of outputs this service can produce in a given time period per team member"
			],
			"probability" => [ 
				"value"=> 2, 
				"description"=> "percent probability of converting an input to an output"
			],
			"processtime" => [ 
				"values"=> [[24,48],[48,72],[72,168],[168,720]],
				"weights"=> [30,50,15,5],
				"description"=> "weighted amount of hours necessary to fullfill the services processes"
			],
			"startdelays" => [
				"probability" => [
					"value" => 50,
					"description" => "probability that this service will be delayed in starting"
				],
				"cost" => [
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [30,50,15,5],
					"description" => "weighted amount of time added to the start date of the service"
				],
				"reason" => [
					"values" => [
						"Customer delays getting requirements to us",
						"Customer delays signing contract",
						"Customer delays initial payment"
					],
					"weights" => [70,10,20],
					"description" => "weighted reasons why the start delay occured beyond its normal input requirements"
				]
			],
			"finishdelays" => [
				"probability" => [
					"value" => 50,
					"description" => "probability that this service will be delayed in finishing"
				],
				"cost" => [
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [30,50,15,5],
					"description" => "weighted amount of time added to the start date of the service"
				],
				"reason" => [
					"values" => [
						"Customer delays getting requirements to us",
						"Customer delays signing contract",
						"Customer delays initial payment"
					],
					"weights" => [70,10,20],
					"description" => "weighted reasons why the finish delay occured"
				],
			],
		],
	],
	"inperson" => [
		"name" => "In Person",
		"department" => "Marketing",
		"inputs" => [],
		"outputs" => [],
		"processes" => [],
		"simulation" => [
			"opportunities" => [ 
				"values"=> [[0,3],[4,6],[7,10],[11,15]],
				"weights"=> [30,57,10,3],
				"description"=> "weighted amount of outputs this service can produce in a given time period per team member"
			],
			"probability" => [ 
				"value"=> 10, 
				"description"=> "percent probability of converting an input to an output"
			],
			"processtime" => [ 
				"values"=> [[24,48],[48,72],[72,168],[168,720]],
				"weights"=> [30,50,15,5],
				"description"=> "weighted amount of hours necessary to fullfill the services processes"
			],
			"startdelays" => [
				"probability" => [
					"value" => 50,
					"description" => "probability that this service will be delayed in starting"
				],
				"cost" => [
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [30,50,15,5],
					"description" => "weighted amount of time added to the start date of the service"
				],
				"reason" => [
					"values" => [
						"Customer delays getting requirements to us",
						"Customer delays signing contract",
						"Customer delays initial payment"
					],
					"weights" => [70,10,20],
					"description" => "weighted reasons why the start delay occured beyond its normal input requirements"
				]
			],
			"finishdelays" => [
				"probability" => [
					"value" => 50,
					"description" => "probability that this service will be delayed in finishing"
				],
				"cost" => [
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [30,50,15,5],
					"description" => "weighted amount of time added to the start date of the service"
				],
				"reason" => [
					"values" => [
						"Customer delays getting requirements to us",
						"Customer delays signing contract",
						"Customer delays initial payment"
					],
					"weights" => [70,10,20],
					"description" => "weighted reasons why the finish delay occured"
				],
			],
		],
	],

];
<?php

return [ 
	"name"=> "Marketing Services",
	"description" => "The goal of marketing services is to create sales leads for a company to persue",
	"config"=> [],
	"services"=> [
		"referral" => [
			"active"=> true,
			"name"=> "Referral",
			"department"=> "Marketing",
			"color" => "#FF6384",
			"class" => "FreshJones\Office\Services\Services\ReferralService",
			"ID" => "MAR-OUT-002-000-000",
			"type" => "Outbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [
				"saleslead" => [
					"class" => "FreshJones\Office\Services\Simulations\SalesServices",
					"description"=> "An Contact who has expressed interest in doing business with us either now or in the future",
					"method" => "CreateSalesLead"
				]
			],
			"simulation" => [
				"classes" => [
					"simulationClass" => [ 
						"value"=> "FreshJones\Office\Services\Simulations\MarketingSimulator", 
						"description"=> "An simulation class object specific to marketing objects" 
					],
					"processClass" => [ 
						"value"=> "FreshJones\Office\Services\Simulations\MarketingProcesser", 
						"description"=> "A process class object for adding service outputs to the system" 
					]
				],
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
					"description"=> "weighted amount of hours necessary to achieve output"
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
					]
				]

			]
		],
		"advertisment" => [
			"active"=> true,
			"name"=> "Advertising",
			"department"=> "Marketing",
			"class" => "FreshJones\Office\Services\Services\AdvertisingService",
			"color" => "#36A2EB",
			"ID" => "MAR-OUT-001-000-000",
			"type" => "Outbound",
			"inputs" => [
				
			],
			"processes" => [],
			"outputs" => [
				"saleslead" => [
					"class" => "FreshJones\Office\Services\Simulations\SalesServices",
					"description"=> "An Contact who has expressed interest in doing business with us either now or in the future",
					"method" => "CreateSalesLead"
				]
			],
			"simulation" => [
				"classes" => [ 
					"simulationClass" => [ 
						"value"=> "FreshJones\Office\Services\Simulations\MarketingSimulator", 
						"description"=> "An simulation class object specific to marketing objects" 
					],
					"processClass" => [ 
						"value"=> "BasicProcessor", 
						"description"=> "A process class object for adding a lead to the system" 
					]
				],
				"opportunities" => [ 
					"values"=> [[0,3],[4,6],[7,10],[11,15]],
					"weights"=> [30,57,10,3],
					"description"=> "weighted amount of outputs this service can produce in a given time period per team member"
				],
				"cost" => [ 
					"values"=> 100,
					"description"=> "the cost of the advertisement per placement" 
				],
				"frequency" => [ 
					"values"=> [3,6,9,12],
					"description"=> "Months the advertisment will run"
				],
				"reach" => [ 
					"values"=> [[1000,1500]],
					"weights"=> [1],
					"description"=> "weighted amount of people likely exposed to the ad"
				],
				"probability" => [ 
					"value"=> 10, 
					"description"=> "percent probability of converting an impression to a lead"
				],
				"age" => [ 
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [0.3,0.5,0.15,0.05],
					"description"=> "weighted time required to convert an impression to a lead"
				],
				"processtime" => [ 
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [0.3,0.5,0.15,0.05],
					"description"=> "weighted amount of hours necessary to achieve output"
				]
			]
		],
		"inperson" => [
			"active"=> true,
			"name"=> "In Person",
			"department"=> "Marketing",
			"class" => "FreshJones\Office\Services\Services\InPersonService",
			"color" => "#FFCE56",
			"ID" => "MAR-OUT-003-000-000",
			"type" => "Outbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [
				"saleslead" => [
					"class" => "FreshJones\Office\Services\Simulations\SalesServices",
					"description"=> "An Contact who has expressed interest in doing business with us either now or in the future",
					"method" => "CreateSalesLead"
				]
			],
			"simulation" => [
				"classes" => [ 
					"simulationClass" => [ 
						"value"=> "FreshJones\Office\Services\Simulations\MarketingSimulator", 
						"description"=> "An simulation class object specific to marketing objects" 
					],
					"processClass" => [ 
						"value"=> "BasicProcessor", 
						"description"=> "A process class object for adding a lead to the system" 
					]
				],
				"opportunities" => [ 
					"values"=> [[0,3],[4,6],[7,10],[11,15]],
					"weights"=> [30,57,10,3],
					"description"=> "weighted amount of outputs this service can produce in a given time period per team member"
				],
				"cost" => [ 
					"values"=> 100,
					"description"=> "the cost of the advertisement per placement" 
				],
				"frequency" => [ 
					"values"=> [3,6,9,12],
					"description"=> "Months the advertisment will run"
				],
				"reach" => [ 
					"values"=> [[1000,1500]],
					"weights"=> [1],
					"description"=> "weighted amount of people likely exposed to the ad"
				],
				"probability" => [ 
					"value"=> 10, 
					"description"=> "percent probability of converting an impression to a lead"
				],
				"age" => [ 
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [0.3,0.5,0.15,0.05],
					"description"=> "weighted time required to convert an impression to a lead"
				],
				"processtime" => [ 
					"values"=> [[24,48],[48,72],[72,168],[168,720]],
					"weights"=> [0.3,0.5,0.15,0.05],
					"description"=> "weighted amount of hours necessary to achieve output"
				]
			]
		],
		"phone" => [
			"active"=> false,
			"name"=> "Phone",
			"department"=> "Marketing",
			"ID" => "MAR-OUT-004-000-000",
			"type" => "Outbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "MarketingSimulation"
		],
		"email" => [
			"active"=> false,
			"name"=> "Email",
			"department"=> "Marketing",
			"ID" => "MAR-OUT-005-000-000",
			"type" => "Outbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "MarketingSimulation"
		],
		"tradeshows" => [
			"active"=> false,
			"name"=> "Tradeshows",
			"department"=> "Marketing",
			"ID" => "MAR-OUT-006-000-000",
			"type" => "Outbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "MarketingSimulation"
		],
		"directmail" => [
			"active"=> false,
			"name"=> "Direct Mail",
			"department"=> "Marketing",
			"ID" => "MAR-OUT-007-000-000",
			"type" => "Outbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "MarketingSimulation"
		],
		"socialmedia" => [
			"active"=> false,
			"name"=> "Social Media",
			"department"=> "Marketing",
			"ID" => "MAR-IN-001-000-000",
			"type" => "Inbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "InboundSimulation"
		],
		"search" => [
			"active"=> false,
			"name"=> "Search",
			"department"=> "Marketing",
			"ID" => "MAR-IN-002-000-000",
			"type" => "Inbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "InboundSimulation"
		],
		"presentations" => [
			"active"=> false,
			"name"=> "Presentations",
			"department"=> "Marketing",
			"ID" => "MAR-IN-003-000-000",
			"type" => "Inbound",
			"inputs" => [],
			"processes" => [],
			"outputs" => [],
			"simulationClass" => "InboundSimulation"
		]
	]
];
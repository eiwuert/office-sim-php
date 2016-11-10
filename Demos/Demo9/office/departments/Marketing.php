<?php

namespace Office\Departments;

use Core\App;

class Marketing extends Department
{

	private $data;
	private $services;

	public function __construct()
	{
		$this->initData();

		$this->initServices();
	}
  	
  	private function initData()
  	{
  		$this->data = App::get('database')->selectAll('marketing');
  	}

  	private function initServices()
  	{
  		foreach($this->data['services'] AS $service)
  		{
  			
  		}
  		echo '<pre>';
  		print_r($this->data);
  		echo '</pre>';
  		die();
  	}

  	public function simulate()
  	{
  		
  		//$test = App::get('departments');
  		
  		echo '<pre>';
  		print_r($this->data);
  		echo '</pre>';
  		die();
  	}
}

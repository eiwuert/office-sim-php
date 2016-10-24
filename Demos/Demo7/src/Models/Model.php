<?php

namespace App\Models;

use App\Support\Config;

abstract class Model
{
	public function __construct()
	{

	}

	abstract function get();

	abstract function set();

}
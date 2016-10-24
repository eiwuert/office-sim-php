<?php

namespace App\Support;

use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;

class Config
{

	private $config;

	public function __construct()
	{

		$di = new RecursiveDirectoryIterator(__DIR__ . '/../Config/',RecursiveDirectoryIterator::SKIP_DOTS);
		$it = new RecursiveIteratorIterator($di);
		foreach($it as $file) 
		{
		    if (pathinfo($file, PATHINFO_EXTENSION) == "json") 
		    {
		        $contents = json_decode(file_get_contents($file->getPathname()),true);
		        $this->config[$contents['id']] = $contents['data'];
		    }
		}
	}

	public function get()
	{
		return $this->config;
	}

}
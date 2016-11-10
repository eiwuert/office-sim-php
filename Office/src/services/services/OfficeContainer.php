<?php

namespace FreshJones\Office\Services\Services;

use Freshjones\Core\Helpers\Container;

class OfficeContainer extends Container
{

	public function getDepartments()
	{
		return $this->get('departments');
	}
}
<?php

namespace MyCompany\Ecomm\Model;

trait Product_GenTrait
{


	public function setId($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Id = (!$check || ($value === null)) ? $value : (int)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setId");
		$this->_id = $return;

		return $return;
	}

	public function setName($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Name = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setName");
		return $return;
	}

	public function setImage($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Image = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setImage");
		return $return;
	}

	public function setPrice($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Price = (!$check || ($value === null)) ? $value : (float)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setPrice");
		return $return;
	}
}


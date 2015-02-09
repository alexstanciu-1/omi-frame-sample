<?php

namespace MyCompany\Ecomm\Model;

trait OrderItem_GenTrait
{


	public function setId($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Id = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setId");
		$this->_id = $return;

		return $return;
	}

	public function setProduct($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Product = (!$check || ($value === null)) ? $value : (($value instanceof \MyCompany\Ecomm\Model\Product) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setProduct");
		return $return;
	}

	public function setQuantity($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Quantity = (!$check || ($value === null)) ? $value : (float)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setQuantity");
		return $return;
	}

	public function setUnitPrice($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->UnitPrice = (!$check || ($value === null)) ? $value : (float)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setUnitPrice");
		return $return;
	}
}


<?php

namespace MyCompany\Ecomm\Model;

trait Order_GenTrait
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

	public function setDate($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Date = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setDate");
		return $return;
	}

	public function setCustomer($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Customer = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setCustomer");
		return $return;
	}

	public function setResponsible($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Responsible = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setResponsible");
		return $return;
	}

	public function setItems($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Items = (!$check || ($value === null)) ? $value : (($value instanceof \QModelArray) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setItems");
		return $return;
	}

	public function setItems_Item_($value, $key = null, $row_id = null, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Items[$key] = (!$check || ($value === null)) ? $value : (($value instanceof \MyCompany\Ecomm\Model\OrderItem) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setItems_Item_");
		if (($fail !== null) && ($key !== null) && ($row_id !== null))
			$this->Items->setRowIdAtIndex($key, $row_id);
		
		return $return;
	}
}


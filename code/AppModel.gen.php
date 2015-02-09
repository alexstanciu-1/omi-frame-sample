<?php

namespace MyCompany\Ecomm\Model;

trait AppModel_GenTrait
{


	public function setVersion($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Version = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setVersion");
		return $return;
	}

	public function setOrders($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Orders = (!$check || ($value === null)) ? $value : (($value instanceof \QModelArray) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setOrders");
		return $return;
	}

	public function setOrders_Item_($value, $key = null, $row_id = null, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Orders[$key] = (!$check || ($value === null)) ? $value : (($value instanceof \MyCompany\Ecomm\Model\Order) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setOrders_Item_");
		if (($fail !== null) && ($key !== null) && ($row_id !== null))
			$this->Orders->setRowIdAtIndex($key, $row_id);
		
		return $return;
	}

	public function setProducts($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Products = (!$check || ($value === null)) ? $value : (($value instanceof \QModelArray) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setProducts");
		return $return;
	}

	public function setProducts_Item_($value, $key = null, $row_id = null, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->Products[$key] = (!$check || ($value === null)) ? $value : (($value instanceof \MyCompany\Ecomm\Model\Product) ? $value : ($fail = null));
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setProducts_Item_");
		if (($fail !== null) && ($key !== null) && ($row_id !== null))
			$this->Products->setRowIdAtIndex($key, $row_id);
		
		return $return;
	}
}


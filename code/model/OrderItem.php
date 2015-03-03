<?php

namespace MyCompany\Ecomm\Model;

/**
 * The item in a Order
 * 
 * @storage.table OrdersItems
 */
class OrderItem extends \QModel
{
	use OrderItem_GenTrait;

	/**
	 * Id
	 * @var integer
	 */
	public $Id;
	/**
	 * @var Product
	 */
	public $Product;
	/**
	 * @var float
	 */
	public $Quantity;
	/**
	 * @var float
	 */
	public $UnitPrice;
}

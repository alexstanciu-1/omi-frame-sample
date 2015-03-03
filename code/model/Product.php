<?php

namespace MyCompany\Ecomm\Model;

/**
 * Represents a product
 * 
 * @storage.table Products
 */
class Product extends \QModel
{
	/**
	 * This is by no means a good idea ! We just need it for our example.
	 */
	use Product_GenTrait, ExposeCRUD;
	/**
	 * We need to query a bit more data for an order
	 * This is only for ExposeCRUD
	 * 
	 * @var string
	 */
	public static $QuerySelector = "*";
	
	/**
	 * The Id
	 * @var integer
	 */
	public $Id;
	/**
	 * The name
	 * @var string
	 */
	public $Name;
	/**
	 * The image
	 * @var file
	 */
	public $Image;
	/**
	 * The price
	 * @var float
	 */
	public $Price;
	/**
	 * The best order
	 * @var Order
	 */
	public $BestOrder;
}

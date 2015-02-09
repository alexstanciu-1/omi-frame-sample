<?php

namespace MyCompany\Ecomm\Model;

/**
 * This is the ROOT model of our App
 * It was set with \QApp::SetDataClass("MyCompany\Ecomm\Model\AppModel");
 * 
 * @storage.table AppModel
 */
class AppModel extends \QModel
{
	use AppModel_GenTrait;
	/**
	 * The version of the app. Not needed, we just test scalars in the main model
	 * @var string
	 */
	public $Version = "1.0";
	/**
	 * List with all orders
	 *
	 * @var Order[]
	 */
	public $Orders;
	/**
	 * List with all products
	 *
	 * @var Product[]
	 */
	public $Products;	
}

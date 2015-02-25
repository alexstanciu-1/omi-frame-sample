<?php

namespace MyCompany\Ecomm\Model;

/**
 * This is just to help with our example. We allow the browser to make some requests without any authentication.
 * This is by no means a good idea! It's just to keep our example simple.
 * 
 * This trait exposes CRUD to API/Ajax calls without making any creditentials checks.
 */
trait ExposeCRUD
{
	/**
	 * We allow insert to any client with @api.enable
	 * 
	 * @api.enable
	 * @param string $selector
	 * @return integer
	 */
	public function insert($selector = "*")
	{
		return parent::insert($selector)->Id;
	}
	
	/**
	 * We allow merge to any client with @api.enable
	 * 
	 * @api.enable
	 * @param string $selector
	 * @return integer
	 */
	public function merge($selector = "*")
	{
		return parent::merge($selector)->Id;
	}
	
	/**
	 * We allow update to any client with @api.enable
	 * 
	 * @api.enable
	 * @param string $selector
	 * @return integer
	 */
	public function update($selector = "*")
	{
		return parent::update($selector)->Id;
	}
	
	/**
	 * We allow detele to any client with @api.enable
	 * 
	 * @api.enable
	 * @param string $selector
	 * @return integer
	 */
	public function detele($selector = "*")
	{
		return parent::detele($selector)->Id;
	}
}

<?php

namespace MyCompany\Util\View;

/**
 * We define DropDown abstract. It's not a must to be abstract
 */
abstract class DropDown extends \QWebControl
{
	use DropDown_GenTrait;
	/**
	 * The default selected value
	 *
	 * @var mixed
	 */
	public $value;
	
	/**
	 * Asks for the data
	 * 
	 * @api.enable
	 * 
	 * @param $filter string
	 * @return mixed[] 
	 */
	public abstract function getData($filter = null);
	/**
	 * @api.enable
	 * @param $item QIModel
	 */
	public abstract function renderItemCaption(\QIModel $item);
}

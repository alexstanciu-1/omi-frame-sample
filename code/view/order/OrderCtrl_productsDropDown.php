<?php
/**
 * This file was generated and it will be overwritten when it's dependencies are changed or removed.
 */

namespace MyCompany\Ecomm\View;

class OrderCtrl_productsDropDown extends \MyCompany\Util\View\DropDown
{
	public function getData($filter = null)
	{
		 
									return \MyCompany\Ecomm\Model\Product::QueryAll("Id,Name,Price WHERE Name LIKE(?) OR Id LIKE (?) ORDER BY Name LIMIT 10", ["%{$filter}%", "%{$filter}%"]); 
	}
	public function renderItemCaption(\QIModel $item)
	{
		?>
									<?= $item->Name ?> id:<span><?= $item->getId() ?></span>
								<?php
	}

}


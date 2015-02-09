<?php

namespace MyCompany\Ecomm\View;
use MyCompany\Ecomm\Model\Order;

trait OrderCtrl_GenTrait
{


	public function setRenderMethod($value, $check = true, $null_on_fail = false)
	{
		$fail = false;
		$return = $this->renderMethod = (!$check || ($value === null)) ? $value : (string)$value;
		if (($fail === null) && (!$null_on_fail))
			throw new \Exception("Failed to assign value in setRenderMethod");
		return $return;
	}

	/**
	 * @api.enable
	 */
	public function renderDetails($order)
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.details.tpl", "Generating (1) JS Functions to: /var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.js\n");
		?><!-- This one is just pure PHP & XML
	 Remember to close all tags (and short close when needed)
     -->
<tr qArgs="$order" jsFunc="renderDetails($order)">
	<?php 
		$order = $order ? $order : $this->order;
		if ($order && is_numeric($order))
			$order = $this->loadOrderById($order);
	
	if ($order->Items)
	{
	?>
	<td colspan="9">
		<small>this element was read with AJAX, data was queried with the ORM</small>
		<table>
			<thead>
				<th></th>
				<th>Item</th>
				<th>Quantity</th>
				<th>Item Price</th>
				<th>Price</th>
			</thead>
			<tbody>
				<?php
					$pos = 1;
					$total = 0;
					foreach ($order->Items as $o_item)
					{
						$i_price = $o_item->UnitPrice * $o_item->Quantity;
						?><tr>
							<td># <?= $o_item->getId() ?></td>
							<td><?= $o_item->Product->Name ?></td>
							<td><?= $o_item->Quantity ?></td>
							<td><?= $o_item->UnitPrice ?></td>
							<td><?= number_format($i_price, 2) ?></td>
						</tr><?php
						$pos++;
						$total += $i_price;
					}
				?>
			</tbody>
			<tfoot>
				<td colspan="3"></td>
				<th>Total</th>
				<th><?= $total ?></th>
			</tfoot>
		</table>
	</td><?php
	}
	else {
		?><td colspan="9">No items !</td><?php
	}
	?>
</tr>
<?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	public function generatedInit()
	{

	}

	/**
	 * @api.enable
	 */
	public function renderEdit($order = null)
	{
				$this->includeJsClass();
		$this->includeJsClass("MyCompany\\Util\\View\\DropDown");
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.edit.tpl", "Generating (3) JS Functions to: /var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.js\n");
		?><!-- 
-->
<div qArgs="$order = null" jsFunc='renderEdit($order)'>
	<?php 
		$order = $order ? $order : $this->order;
		if ($order && is_numeric($order))
			$order = $this->loadOrderById($order);
		
	?>
	<h6>Order #<?= $order ? $order->getId() : "NEW" ?><br/>
	<small><i><?= $order ? $order->Date : date("Y-m-d h:m:s") ?></i></small></h6>
	<?php if ($this->showBackButton) { ?><button onclick="history.back()">&laquo; Go Back</button><?php } ?>
	
	<div class="row order-form" qb="$Order(MyCompany\Ecomm\Model\Order)">
		<div class="six columns">
			<label>Order Id</label>
			<input qb=".Id" class="u-full-width" type="text" value="<?= $order ? $order->getId() : "" ?>" readonly="true" />
			<label>Order Date</label>
			<input qb=".Date" class="u-full-width" type="text" value="<?= $order ? $order->Date : date("Y-m-d h:m:s") ?>"  />
		</div>
		<div class="six columns">
			<label>Customer</label>
			<input qb=".Customer" class="u-full-width" type="text" value="<?= $order ? $order->Customer : "" ?>" />
			<label>Responsible</label>
			<input class="u-full-width" type="text" value="<?= $order ? $order->Responsible : "" ?>" readonly="true" />
		</div>
		<label>Order Items</label>
		<table class="u-full-width">
			<thead>
				<tr>
					<th></th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Item Price</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody qb=".Items[+]">
			<?php
			if ($order && $order->Items)
			{
				?><?php
				$pos = 1;
				foreach ($order->Items as $ord_item)
				{
					?><tr qb=".(MyCompany\Ecomm\Model\OrderItem)" jsFunc='renderEditItem($ord_item, $pos)'>
						<td qb=".Id" qbValue="<?= $ord_item ? $ord_item->getId() : "null" ?>">#<?= $ord_item ? $ord_item->getId() : "" ?></td>
						<td>
							<?php $dropDown = ${"dropDown{$pos}"} = new OrderCtrl_productsDropDown();
									// If this PHP code block is not present then it is created and an instance of the control is created
									$this->addControl($dropDown);
									$dropDown->init();
									$dropDown->qb = ".Product(\\MyCompany\\Ecomm\\Model\\Product)";
									$dropDown->selectedItem = $ord_item ? $ord_item->Product : null;
									$dropDown->render();
								 ?>
						</td>
						<td>
							<input qb=".Quantity" class="u-full-width" type="number" value="<?= $ord_item ? $ord_item->Quantity : "" ?>" />
						</td>
						<td>
							<input class="u-full-width" type="number" value="<?= $ord_item ? $ord_item->UnitPrice : "" ?>" <?= (!$ord_item) ? "readonly" : "" ?> />
						</td>
						<td>
							<?= $ord_item ? number_format(($ord_item->Quantity * $ord_item->UnitPrice), 2) : "" ?>
						</td>
						<td><a onclick="var jq_tr = jQuery(this).closest('tr'); qbDelete(jq_tr); jq_tr.hide('slow');" href="javascript://">remove</a></td>
						<td><a onclick="var jq_tr = jQuery(this).closest('tr'); qbUnlink(jq_tr); jq_tr.hide('slow');" href="javascript://">unlink</a></td>
					</tr><?php
					$pos++;
				}
			}
			?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td colspan="5"><button onclick="$ctrl(this).callRenderEditItem(this);">Add Order Item</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<input class="button-primary" type="submit" onclick="$ctrl(this).saveForm(); return false;" value="Submit" />
</div><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	/**
	 * @api.enable
	 */
	public function renderItem($order = null, $action = null)
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.item.tpl", "Generating (1) JS Functions to: /var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.js\n");
		?><!-- 
	The only frame feature here is the "jsFunc" directive
	When you set the "jsFunc" attribute on an HTML/XML element you are asking the frame to 
    genetate a Javascript render function for that element.
    The generated function will be placed in the .js file associated with the template's web control.
	This feature can be nested.
	We don't have a full implementation of PHP to Javascript but for the purpose of a template
	when you should have the data prepared and you would only need to render it, it should be ok.
-->
<div qArgs="$order = null, $action = null" jsFunc='renderItem($order, $action)'>
	<?php 
		$order = $order ? $order : $this->order;
		if ($order && is_numeric($order))
			$order = $this->loadOrderById($order);
		$action = $action ? $action : $this->action;
	?>
	<h6>Order #<?= $order->getId() ?><br/>
	<small><i><?= $order->Date ?></i></small></h6>
	<?php if ($this->showBackButton) { ?><button onclick="history.back()">&laquo; Go Back</button><?php } ?>
	
	<div class="row">
		<div class="six columns">
			<label>Order Id</label>
			<span><?= $order->getId() ?></span>
			<label>Order Date</label>
			<span><?= $order->Date ?></span>
		</div>
		<div class="six columns">
			<label>Customer</label>
			<span><?= $order->Customer ?></span>
			<label>Responsible</label>
			<span><?= $order->Responsible ?></span>
		</div>
		<label>Order Items</label>
		<table class="u-full-width">
			<thead>
				<tr>
					<th></th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Item Price</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if ($order->Items) {
				
				$pos = 1;
				$total = 0.0;
				foreach ($order->Items as $ord_item)
				{
					$item_total = round($ord_item->Quantity * $ord_item->UnitPrice, 2);
					$total += $item_total;
					?><tr>
						<td>#<?= $pos ?></td>
						<td>
							<span><?= $ord_item->Product->Name ?></span>
						</td>
						<td>
							<span><?= $ord_item->Quantity ?></span>
						</td>
						<td>
							<span><?= $ord_item->UnitPrice ?></span>
						</td>
						<td>
							<?= number_format($item_total, 2) ?>
						</td>
					</tr><?php
					$pos++;
				}
			}
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"></td>
					<th>Total</th>
					<th><?= number_format($total, 2) ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php
		if ($action === "delete") {
			?><button onclick="if (confirm('Are you sure ?')) $ctrl(this).deleteOrder(<?= $order->getId() ?>); return false;">Delete Order</button><?php
		}
	?>
</div><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	/**
	 * @api.enable
	 */
	public function renderList()
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.list.tpl", "");
		?><!-- Just listing the orders here -->
<?php

	$this->data = $this->data ? $this->data : \MyCompany\Ecomm\Model\Order::GetListingOrders();

?><table class="u-full-width">
	<thead>
		<tr>
			<th></th>
			<th>Order Id</th>
			<th>Date</th>
			<th>Customer</th>
			<th>Items</th>
			<th>Total</th>
			<th>Actions</th>
			<th>AJAX</th>
			<th>JSON</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="6"></td>
			<td><a href="<?= $this->url("create") ?>">create</a></td>
			<td><a onclick="$ctrl(this).execAction('create', 'ajax');" href="javascript:">create</a></td>
			<td><a onclick="$ctrl(this).execAction('create', 'json');" href="javascript:">create</a></td>
		</tr>
	<?php
	if ($this->data):
		foreach ($this->data as $order):?>
			<tr>
				<td><a onclick="$ctrl(this).showDetails(<?= $order->getId() ?>, jQuery(this).closest('tr'));">[+]</a></td>
				<td><?= $order->Id; ?></td>
				<td><?= $order->Date; ?></td>
				<td><?= $order->Customer; ?></td>
				<td><?= $order->ItemsCount; ?></td>
				<td class="right"><?= number_format($order->ItemsTotal, 2); ?></td>
				<td>
					<a href="<?= $this->url("view", $order->getId()) ?>"><i class="fa fa-eye"></i></a>
					<a href="<?= $this->url("edit", $order->getId()) ?>"><i class="fa fa-edit"></i></a>
					<a href="<?= $this->url("delete", $order->getId()) ?>"><i class="fa fa-trash-o"></i></a>
				</td>
				<td>
					<a href="javascript://" onclick="$ctrl(this).execAction('view', 'ajax', <?= $order->getId() ?>);"><i class="fa fa-eye"></i></a>
					<a href="javascript://" onclick="$ctrl(this).execAction('edit', 'ajax', <?= $order->getId() ?>);"><i class="fa fa-edit"></i></a>
					<a href="javascript://" onclick="$ctrl(this).execAction('delete', 'ajax', <?= $order->getId() ?>);"><i class="fa fa-trash-o"></i></a>
				</td>
				<td>
					<a href="javascript://" onclick="$ctrl(this).execAction('view', 'json', <?= $order->getId() ?>);"><i class="fa fa-eye"></i></a>
					<a href="javascript://" onclick="$ctrl(this).execAction('edit', 'json', <?= $order->getId() ?>);"><i class="fa fa-edit"></i></a>
					<a href="javascript://" onclick="$ctrl(this).execAction('delete', 'json', <?= $order->getId() ?>);"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr>
		<?php endforeach;
	endif;
	?>
	</tbody>
</table>
<p>The listing is limited to 50 results.</p><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	/**
	 * @api.enable
	 */
	public function render()
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~users/alex/omi-frame-sample/code/view/order/OrderCtrl.tpl", "");
		?><div style="max-width: 900px; padding: 20px; margin: 0 auto;" qCtrl="<?=$this->name."(".get_class($this).")"?>" class="QWebControl">
	<h5><a href="">Orders</a></h5>
	<p>
		<small>This page uses cookies to isolate each user's data. By staying on the page you accept them.<br/></small>
		<strong>Actions</strong>: Old school links/URLs, HTML without AJAX, without JSON.<br/>
		<strong>AJAX</strong>: We get the HTML with AJAX and present it in a popup.<br/>
		<strong>JSON</strong>: We get the HTML from generated JS render methods and the data via JSON with AJAX.
	</p>
	<?php
	
		$this->{$this->renderMethod}();
	
	?>
</div><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	public static function GetUrl_($_this, $tag, &$url = null, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		$_tag_parts = null;
		$tag = is_string($tag) ? reset($_tag_parts = explode("/", $tag)) : reset($_tag_parts = $tag);
		$_shift = false;
		switch ($tag)
		{
			case "delete":
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && ($_this->parentPrefixUrl !== null))
					$url[] = $_this->parentPrefixUrl;
				$id = $_arg0;
				$url[] = $url_part =  "delete/".urlencode($id ?: ($_this ? $_this->orderId : ""));
				if (!next($_tag_parts))
					return $_called ? implode("/", $url) : $url;
				break;

			}
		
			case "edit":
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && ($_this->parentPrefixUrl !== null))
					$url[] = $_this->parentPrefixUrl;
				$id = $_arg0;
				$url[] = $url_part =  "edit/".urlencode($id ?: ($_this ? $_this->orderId : ""));
				if (!next($_tag_parts))
					return $_called ? implode("/", $url) : $url;
				break;

			}
		
			case "view":
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && ($_this->parentPrefixUrl !== null))
					$url[] = $_this->parentPrefixUrl;
				$id = $_arg0;
				$url[] = $url_part =  "view/".urlencode($id ?: ($_this ? $_this->orderId : ""));
				if (!next($_tag_parts))
					return $_called ? implode("/", $url) : $url;
				break;

			}
		
			case "create":
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && ($_this->parentPrefixUrl !== null))
					$url[] = $_this->parentPrefixUrl;
				$url[] = $url_part = qTranslate("create");
				if (!next($_tag_parts))
					return $_called ? implode("/", $url) : $url;
				break;

			}
		
			default:
			{
			}
		}
	}

	public static function GetUrl($tag, &$url = null, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		return self::GetUrl_(null, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
	}

	public function getUrlForTag_($tag, &$url = null, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		return self::GetUrl_($this, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
	}

	public function getUrlForTag($tag, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		$url = null;
		return self::GetUrl_($this, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
	}

	public function getUrlSelf($tag, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		$url = null;
		$saved = $this->parentPrefixUrl;
		$this->parentPrefixUrl = null;
		$return = self::GetUrl_($this, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
		$this->parentPrefixUrl = $saved;
		return $return;
	}

	public function loadFromUrl(\QUrl $url, $parent = null)
	{
		$this->parentPrefixUrl = $url->getConsumedAsString() ?: null;
		// we should change this in the future, needed by admin module atm
		$init_return = $this->initController($url, $parent);
		if ($init_return !== null)
			$_rv = $init_return;
		else if (\QWebRequest::IsFastAjax())
			$_rv = true;
		else if ((!$_rv) && ($testResult = ($url->current() == qTranslate("create"))))
			$_rv = $this->loadUrlCreate($url, $testResult);
		else if ((!$_rv) && ($testResult = ( ($url->current() === "view") ? (($id = (int)$url->next()) ? $id : false) : false )))
			$_rv = $this->loadUrlView($url, $testResult);
		else if ((!$_rv) && ($testResult = ( ($url->current() === "edit") ? (($id = (int)$url->next()) ? $id : false) : false )))
			$_rv = $this->loadUrlEdit($url, $testResult);
		else if ((!$_rv) && ($testResult = ( ($url->current() === "delete") ? (($id = (int)$url->next()) ? $id : false) : false )))
			$_rv = $this->loadUrlDelete($url, $testResult);
		// this will always be executed
		// var_dump("i always do this");
	
		return $_rv;
	}

	public function initController(\QUrl $url = null, $parent = null)
	{
				// this will always be executed
		// var_dump("i always do this");
	
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlCreate
	 */
	public function loadUrlCreate(\QUrl $url, $testResult)
	{
			$this->renderMethod = "renderEdit";
			$this->action = "create";
			return true;
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlView
	 */
	public function loadUrlView(\QUrl $url, $testResult)
	{
			// $testResult is what <test> returns
			$this->renderMethod = "renderItem";
			$this->orderId = $testResult;
			$this->loadOrderById($this->orderId);
			$this->action = "view";
			return true;
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlEdit
	 */
	public function loadUrlEdit(\QUrl $url, $testResult)
	{
			// $testResult is what <test> returns
			$this->renderMethod = "renderEdit";
			$this->orderId = $testResult;
			$this->loadOrderById($this->orderId);
			$this->action = "edit";
			return true;
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlDelete
	 */
	public function loadUrlDelete(\QUrl $url, $testResult)
	{
			// $testResult is what <test> returns
			$this->renderMethod = "renderItem";
			$this->orderId = $testResult;
			$this->loadOrderById($this->orderId);
			$this->action = "delete";
			return true;
	}
}


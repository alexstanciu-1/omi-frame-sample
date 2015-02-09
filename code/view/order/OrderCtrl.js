/**
 * This is how we build classes in JS.
 * In this example OrderCtrl extends QWebControl
 * Notice that you will have to include the namespace also
 */
QExtendClass("MyCompany\\Ecomm\\View\\OrderCtrl", "QWebControl",
{
	/**
	 * You may add static properties and functions here
	 */
	__static: {
		
	},
	
	/**
	 * __ClassLoaded will be called after the CLASS is defined
	 * This is optional
	 */
	__ClassLoaded: function()
	{
		// nothing to do here
	},
	
	/**
	 * Shows the details under a listed Order
	 * 
	 * @param {integer} order_id
	 * @param {jQuery} insert_after
	 */
	showDetails: function(order_id, insert_after)
	{
		// check if it was not already loaded
		if (insert_after.data("wasLoaded"))
		{
			insert_after.next().toggle();
			return;
		}
		
		// You may call any method on the server that is flagged as @api.enable
		/**
		 * "renderDetails" is the method name
		 * [order_id] the parameters to be sent (as Array)
		 * Last is the callback to be executed on success
		 */
		this.call("renderDetails", [order_id], function (response)
			{
				var html = response;
				insert_after.after(html);
				insert_after.data("wasLoaded", true);
			});
	},
	
	/**
	 * We have created one methods to handle all call types
	 * 
	 * @param {string} action Possible actions: create, edit, view, delete
	 * @param {string} mode Possible modes: ajax, json
	 * @param {integer} order_id
	 * 
	 */
	execAction: function(action, mode, order_id)
	{
		var $params = order_id ? [order_id] : [null];
		$params.push(action);
		var $render_method = ((action === "view") || (action === "delete")) ? "renderItem" : "renderEdit";
		
		// On JSON mode we take only the data from the server and the render is client side
		if (mode === "json")
		{
			var ref_this = this;
			if (order_id)
			{
				this.call("loadOrderById", [order_id], function (resp)
				{
					var html = ref_this[$render_method](resp, action);
					createModal(html);
				});
			}
			else
			{
				var html = ref_this[$render_method](null, action);
				createModal(html);
			}
		}
		// On AJAX mode we take the render with data from the server
		else // if AJAX
		{
			this.call($render_method, $params, function (resp)
			{
				createModal(resp);
			});
		}
	},
	
	/**
	 * Saves the Order via a OrderCtrl.saveForm()
	 * @param {function} on_done
	 */
	saveForm: function(on_done)
	{
		// the result could be cached and reused later, for now we are happy like this
		var form = this.jQuery(".order-form");
		var order_obj = qbGet(form);
		var modal_box = this.jQuery().closest(".qBoxWrap");
		
		this.call("saveForm", [order_obj], function (resp)
				{
					if (on_done)
						on_done(resp);
					else if (modal_box.length)
					{
						// close modal and refresh
						modal_box.remove();
						location.reload();
					}
					else
					{
						history.back();
					}
				});
	},
	
	/**
	 * Deletes an order via OrderCtrl.deleteOrder()
	 * 
	 * @param {integer} order_id
	 * @param {function} on_done
	 */
	deleteOrder: function(order_id, on_done)
	{
		var modal_box = this.jQuery().closest(".qBoxWrap");
		
		this.call("deleteOrder", [order_id], function (resp)
				{
					if (on_done)
						on_done(resp);
					else if (modal_box.length)
					{
						// close modal and refresh
						modal_box.remove();
						location.reload();
					}
					else
					{
						history.back();
					}
				});
	},
	
	/**
	 * Just a small "shortcut" code to call renderEditItem and append it in the right place
	 */
	callRenderEditItem: function()
	{
		this.jQuery("table tbody").append(this.renderEditItem());
	}
});


// ONLY GENERATED CODE FROM HERE


/** Begin :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderEditItem **/
QExtendClass("MyCompany\\Ecomm\\View\\OrderCtrl", "QWebControl", {
renderEditItem: function($ord_item, $pos)
{

		var $_QOUT = "";

$_QOUT += "<tr qb=\".(MyCompany\\Ecomm\\Model\\OrderItem)\" jsFunc=\'renderEditItem($ord_item, $pos)\'>\n" + 
			"						<td qb=\".Id\" qbValue=\"" + ( $ord_item ? $ord_item.getId() : "null" ) + "\">#" + ( $ord_item ? $ord_item.getId() : "" ) + "</td>\n" + 
			"						<td>\n" + 
			"							";
var $dropDown = $ctrl("MyCompany\\Ecomm\\View\\OrderCtrl_productsDropDown");
									// If this PHP code block is not present then it is created and an instance of the control is created
									this.addControl($dropDown);
									$dropDown.init();
									$dropDown.qb = ".Product(\\MyCompany\\Ecomm\\Model\\Product)";
									$dropDown.selectedItem = $ord_item ? $ord_item.Product : null;
									$_QOUT += $dropDown.render();
								
$_QOUT += "\n" + 
			"						</td>\n" + 
			"						<td>\n" + 
			"							<input qb=\".Quantity\" class=\"u-full-width\" type=\"number\" value=\"" + ( $ord_item ? $ord_item.Quantity : "" ) + "\" />\n" + 
			"						</td>\n" + 
			"						<td>\n" + 
			"							<input class=\"u-full-width\" type=\"number\" value=\"" + ( $ord_item ? $ord_item.UnitPrice : "" ) + "\" " + ( (!$ord_item) ? "readonly" : "" ) + " />\n" + 
			"						</td>\n" + 
			"						<td>\n" + 
			"							" + ( $ord_item ? number_format(($ord_item.Quantity * $ord_item.UnitPrice), 2) : "" ) + "						</td>\n" + 
			"						<td><a onclick=\"var jq_tr = jQuery(this).closest(\'tr\'); qbDelete(jq_tr); jq_tr.hide(\'slow\');\" href=\"javascript://\">remove</a></td>\n" + 
			"						<td><a onclick=\"var jq_tr = jQuery(this).closest(\'tr\'); qbUnlink(jq_tr); jq_tr.hide(\'slow\');\" href=\"javascript://\">unlink</a></td>\n" + 
			"					</tr>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderEditItem **/



/** Begin :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderEdit **/
QExtendClass("MyCompany\\Ecomm\\View\\OrderCtrl", "QWebControl", {
renderEdit: function($order)
{

		var $_QOUT = "";

$_QOUT += "<div qArgs=\"$order = null\" jsFunc=\'renderEdit($order)\'>\n" + 
			"	";
		$order = $order ? $order : this.order;
		if ($order && is_numeric($order))
			$order = this.loadOrderById($order);
		
	$_QOUT += "	<h6>Order #" + ( $order ? $order.getId() : "NEW" ) + "<br/>\n" + 
			"	<small><i>" + ( $order ? $order.Date : date("Y-m-d h:m:s") ) + "</i></small></h6>\n" + 
			"	";if (this.showBackButton) { $_QOUT += "<button onclick=\"history.back()\">&laquo; Go Back</button>";} $_QOUT += "	\n" + 
			"	<div class=\"row order-form\" qb=\"$Order(MyCompany\\Ecomm\\Model\\Order)\">\n" + 
			"		<div class=\"six columns\">\n" + 
			"			<label>Order Id</label>\n" + 
			"			<input qb=\".Id\" class=\"u-full-width\" type=\"text\" value=\"" + ( $order ? $order.getId() : "" ) + "\" readonly=\"true\" />\n" + 
			"			<label>Order Date</label>\n" + 
			"			<input qb=\".Date\" class=\"u-full-width\" type=\"text\" value=\"" + ( $order ? $order.Date : date("Y-m-d h:m:s") ) + "\"  />\n" + 
			"		</div>\n" + 
			"		<div class=\"six columns\">\n" + 
			"			<label>Customer</label>\n" + 
			"			<input qb=\".Customer\" class=\"u-full-width\" type=\"text\" value=\"" + ( $order ? $order.Customer : "" ) + "\" />\n" + 
			"			<label>Responsible</label>\n" + 
			"			<input class=\"u-full-width\" type=\"text\" value=\"" + ( $order ? $order.Responsible : "" ) + "\" readonly=\"true\" />\n" + 
			"		</div>\n" + 
			"		<label>Order Items</label>\n" + 
			"		<table class=\"u-full-width\">\n" + 
			"			<thead>\n" + 
			"				<tr>\n" + 
			"					<th></th>\n" + 
			"					<th>Item</th>\n" + 
			"					<th>Quantity</th>\n" + 
			"					<th>Item Price</th>\n" + 
			"					<th>Price</th>\n" + 
			"					<th></th>\n" + 
			"				</tr>\n" + 
			"			</thead>\n" + 
			"			<tbody qb=\".Items[+]\">\n" + 
			"			";			if ($order && $order.Items)
			{
				$_QOUT += "";				$pos = 1;
				var $_expr_ord_item = $order.Items ;
if ($_expr_ord_item._ty && ($_expr_ord_item._ty === 'QModelArray'))
	$_expr_ord_item = $_expr_ord_item._items;
var $_isArr_ord_item = Array.isArray($_expr_ord_item);
for (var $_key_ord_item in $_expr_ord_item)
{

		if ($_isArr_ord_item && (!(($_key_ord_item >=0) && ($_key_ord_item < $_expr_ord_item.length))))
			continue;
		$ord_item = $_expr_ord_item[$_key_ord_item];

					$_QOUT += "" +  this.renderEditItem($ord_item,$pos); + "";					$pos++;
				}

			}
			$_QOUT += "			</tbody>\n" + 
			"			<tfoot>\n" + 
			"				<tr>\n" + 
			"					<td></td>\n" + 
			"					<td colspan=\"5\"><button onclick=\"$ctrl(this).callRenderEditItem(this);\">Add Order Item</button></td>\n" + 
			"				</tr>\n" + 
			"			</tfoot>\n" + 
			"		</table>\n" + 
			"	</div>\n" + 
			"	<input class=\"button-primary\" type=\"submit\" onclick=\"$ctrl(this).saveForm(); return false;\" value=\"Submit\" />\n" + 
			"</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderEdit **/



/** Begin :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderItem **/
QExtendClass("MyCompany\\Ecomm\\View\\OrderCtrl", "QWebControl", {
renderItem: function($order, $action)
{

		var $_QOUT = "";

$_QOUT += "<div qArgs=\"$order = null, $action = null\" jsFunc=\'renderItem($order, $action)\'>\n" + 
			"	";
		$order = $order ? $order : this.order;
		if ($order && is_numeric($order))
			$order = this.loadOrderById($order);
		$action = $action ? $action : this.action;
	$_QOUT += "	<h6>Order #" + ( $order.getId() ) + "<br/>\n" + 
			"	<small><i>" + ( $order.Date ) + "</i></small></h6>\n" + 
			"	";if (this.showBackButton) { $_QOUT += "<button onclick=\"history.back()\">&laquo; Go Back</button>";} $_QOUT += "	\n" + 
			"	<div class=\"row\">\n" + 
			"		<div class=\"six columns\">\n" + 
			"			<label>Order Id</label>\n" + 
			"			<span>" + ( $order.getId() ) + "</span>\n" + 
			"			<label>Order Date</label>\n" + 
			"			<span>" + ( $order.Date ) + "</span>\n" + 
			"		</div>\n" + 
			"		<div class=\"six columns\">\n" + 
			"			<label>Customer</label>\n" + 
			"			<span>" + ( $order.Customer ) + "</span>\n" + 
			"			<label>Responsible</label>\n" + 
			"			<span>" + ( $order.Responsible ) + "</span>\n" + 
			"		</div>\n" + 
			"		<label>Order Items</label>\n" + 
			"		<table class=\"u-full-width\">\n" + 
			"			<thead>\n" + 
			"				<tr>\n" + 
			"					<th></th>\n" + 
			"					<th>Item</th>\n" + 
			"					<th>Quantity</th>\n" + 
			"					<th>Item Price</th>\n" + 
			"					<th>Price</th>\n" + 
			"				</tr>\n" + 
			"			</thead>\n" + 
			"			<tbody>\n" + 
			"			";			if ($order.Items) {
				
				$pos = 1;
				$total = 0.0;
				var $_expr_ord_item = $order.Items ;
if ($_expr_ord_item._ty && ($_expr_ord_item._ty === 'QModelArray'))
	$_expr_ord_item = $_expr_ord_item._items;
var $_isArr_ord_item = Array.isArray($_expr_ord_item);
for (var $_key_ord_item in $_expr_ord_item)
{

		if ($_isArr_ord_item && (!(($_key_ord_item >=0) && ($_key_ord_item < $_expr_ord_item.length))))
			continue;
		$ord_item = $_expr_ord_item[$_key_ord_item];

					$item_total = round($ord_item.Quantity * $ord_item.UnitPrice, 2);
					$total += $item_total;
					$_QOUT += "<tr>\n" + 
			"						<td>#" + ( $pos ) + "</td>\n" + 
			"						<td>\n" + 
			"							<span>" + ( $ord_item.Product.Name ) + "</span>\n" + 
			"						</td>\n" + 
			"						<td>\n" + 
			"							<span>" + ( $ord_item.Quantity ) + "</span>\n" + 
			"						</td>\n" + 
			"						<td>\n" + 
			"							<span>" + ( $ord_item.UnitPrice ) + "</span>\n" + 
			"						</td>\n" + 
			"						<td>\n" + 
			"							" + ( number_format($item_total, 2) ) + "						</td>\n" + 
			"					</tr>";					$pos++;
				}

			}
			$_QOUT += "			</tbody>\n" + 
			"			<tfoot>\n" + 
			"				<tr>\n" + 
			"					<td colspan=\"3\"></td>\n" + 
			"					<th>Total</th>\n" + 
			"					<th>" + ( number_format($total, 2) ) + "</th>\n" + 
			"				</tr>\n" + 
			"			</tfoot>\n" + 
			"		</table>\n" + 
			"	</div>\n" + 
			"	";		if ($action === "delete") {
			$_QOUT += "<button onclick=\"if (confirm(\'Are you sure ?\')) $ctrl(this).deleteOrder(" + ( $order.getId() ) + "); return false;\">Delete Order</button>";		}
	$_QOUT += "</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderItem **/



/** Begin :: Generated function: MyCompany\Ecomm\View\OrderCtrl_productsDropDown::renderItemCaption **/
QExtendClass("MyCompany\\Ecomm\\View\\OrderCtrl_productsDropDown", "MyCompany\\Util\\View\\DropDown", {
renderItemCaption: function($item)
{

		var $_QOUT = "";

$_QOUT += "									" + ( $item.Name ) + " id:<span>" + ( $item.getId() ) + "</span>\n" + 
			"								";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Ecomm\View\OrderCtrl_productsDropDown::renderItemCaption **/




/** Begin :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderDetails **/
QExtendClass("MyCompany\\Ecomm\\View\\OrderCtrl", "QWebControl", {
renderDetails: function($order)
{

		var $_QOUT = "";

$_QOUT += "<tr qArgs=\"$order\" jsFunc=\"renderDetails($order)\">\n" + 
			"	";
		$order = $order ? $order : this.order;
		if ($order && is_numeric($order))
			$order = this.loadOrderById($order);
	
	if ($order.Items)
	{
	$_QOUT += "	<td colspan=\"9\">\n" + 
			"		<small>this element was read with AJAX, data was queried with the ORM</small>\n" + 
			"		<table>\n" + 
			"			<thead>\n" + 
			"				<th></th>\n" + 
			"				<th>Item</th>\n" + 
			"				<th>Quantity</th>\n" + 
			"				<th>Item Price</th>\n" + 
			"				<th>Price</th>\n" + 
			"			</thead>\n" + 
			"			<tbody>\n" + 
			"				";					$pos = 1;
					$total = 0;
					var $_expr_o_item = $order.Items ;
if ($_expr_o_item._ty && ($_expr_o_item._ty === 'QModelArray'))
	$_expr_o_item = $_expr_o_item._items;
var $_isArr_o_item = Array.isArray($_expr_o_item);
for (var $_key_o_item in $_expr_o_item)
{

		if ($_isArr_o_item && (!(($_key_o_item >=0) && ($_key_o_item < $_expr_o_item.length))))
			continue;
		$o_item = $_expr_o_item[$_key_o_item];

						$i_price = $o_item.UnitPrice * $o_item.Quantity;
						$_QOUT += "<tr>\n" + 
			"							<td># " + ( $o_item.getId() ) + "</td>\n" + 
			"							<td>" + ( $o_item.Product.Name ) + "</td>\n" + 
			"							<td>" + ( $o_item.Quantity ) + "</td>\n" + 
			"							<td>" + ( $o_item.UnitPrice ) + "</td>\n" + 
			"							<td>" + ( number_format($i_price, 2) ) + "</td>\n" + 
			"						</tr>";						$pos++;
						$total += $i_price;
					}

				$_QOUT += "			</tbody>\n" + 
			"			<tfoot>\n" + 
			"				<td colspan=\"3\"></td>\n" + 
			"				<th>Total</th>\n" + 
			"				<th>" + ( $total ) + "</th>\n" + 
			"			</tfoot>\n" + 
			"		</table>\n" + 
			"	</td>";	}
	else {
		$_QOUT += "<td colspan=\"9\">No items !</td>";	}
	$_QOUT += "</tr>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Ecomm\View\OrderCtrl::renderDetails **/


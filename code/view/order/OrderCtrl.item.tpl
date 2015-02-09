<!-- 
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
</div>
<!-- 
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
							<qCtrl qCtrl="MyCompany\Util\View\DropDown" tag="productsDropDown" name="dropDown{$pos}">
								<!-- 
									<script type="text/javascript">
										$dropDown.init();
										$dropDown.qb = ".Product(\\MyCompany\\Ecomm\\Model\\Product)";
										$dropDown.selectedItem = $ord_item ? $ord_item.Product : null;
										$_QOUT += $dropDown.render();
									</script>
								-->
								<?php
									// If this PHP code block is not present then it is created and an instance of the control is created
									$this->addControl($dropDown);
									$dropDown->init();
									$dropDown->qb = ".Product(\\MyCompany\\Ecomm\\Model\\Product)";
									$dropDown->selectedItem = $ord_item ? $ord_item->Product : null;
									$dropDown->render();
								?>
								<getData args="$filter = null"><?php 
									return \MyCompany\Ecomm\Model\Product::QueryAll("Id,Name,Price WHERE Name LIKE(?) OR Id LIKE (?) ORDER BY Name LIMIT 10", ["%{$filter}%", "%{$filter}%"]); ?></getData>
								<renderItemCaption args="\QIModel $item" jsFunc="renderItemCaption($item)">
									<?= $item->Name ?> id:<span><?= $item->getId() ?></span>
								</renderItemCaption>
							</qCtrl>
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
</div>
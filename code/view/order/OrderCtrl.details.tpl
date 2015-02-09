<!-- This one is just pure PHP & XML
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

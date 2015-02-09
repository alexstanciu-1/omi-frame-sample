<!-- Just listing the orders here -->
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
<p>The listing is limited to 50 results.</p>
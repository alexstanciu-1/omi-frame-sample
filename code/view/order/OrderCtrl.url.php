<urls>
	<?php
		// this will always be executed
		// var_dump("i always do this");
	?>
	<!-- define the 'create' url -->
	<url tag='create'>
		<get translate='create' />
		<load><?php
			$this->renderMethod = "renderEdit";
			$this->action = "create";
			return true;
		?></load>
	</url>
	<!-- define the 'view' url -->
	<url tag='view'>
		<get param.0="id"><?= "view/".urlencode($id ?: ($this ? $this->orderId : "")); ?></get>
		<test><?= ($url->current() === "view") ? (($id = (int)$url->next()) ? $id : false) : false; ?></test>
		<load><?php
			// $testResult is what <test> returns
			$this->renderMethod = "renderItem";
			$this->orderId = $testResult;
			$this->loadOrderById($this->orderId);
			$this->action = "view";
			return true;
		?></load>
	</url>
	<!-- define the 'edit' url -->
	<url tag='edit'>
		<get param.0="id"><?= "edit/".urlencode($id ?: ($this ? $this->orderId : "")); ?></get>
		<test><?= ($url->current() === "edit") ? (($id = (int)$url->next()) ? $id : false) : false; ?></test>
		<load><?php
			// $testResult is what <test> returns
			$this->renderMethod = "renderEdit";
			$this->orderId = $testResult;
			$this->loadOrderById($this->orderId);
			$this->action = "edit";
			return true;
		?></load>
	</url>
	<!-- define the 'delete' url -->
	<url tag='delete'>
		<get param.0="id"><?= "delete/".urlencode($id ?: ($this ? $this->orderId : "")); ?></get>
		<test><?= ($url->current() === "delete") ? (($id = (int)$url->next()) ? $id : false) : false; ?></test>
		<load><?php
			// $testResult is what <test> returns
			$this->renderMethod = "renderItem";
			$this->orderId = $testResult;
			$this->loadOrderById($this->orderId);
			$this->action = "delete";
			return true;
		?></load>
	</url>
</urls>
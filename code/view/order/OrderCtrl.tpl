<div style="max-width: 900px; padding: 20px; margin: 0 auto;">
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
</div>
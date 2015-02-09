<!-- renders the drop down options with or without a filter 
	you also have the option to specify the data
-->
<div qArgs="$filter, $data = null" jsFunc="renderOptions($filter, $data)">
	<?php
		// if the filter is array then we assume that is the actual data
		$filter = qis_array($filter) ? null : $filter;
		// if no data, we query for it based on the filter
		$data = qis_array($filter) ? $filter : ($data ? $data : $this->getData($filter));
		
		if (!$data) {
			?><i>No Results</i><?php
		}
		else {
			foreach ($data as $item) 
				$this->renderItem($item);
		}
	?>
</div>
<?php

namespace MyCompany\Util\View;

trait DropDown_GenTrait
{


	/**
	 * @api.enable
	 */
	public function renderItem(\QIModel $item)
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~omibit/repos/alex/frame/tests/framesite/_first-app/code/view/dropdown/DropDown.item.tpl", "Generating (1) JS Functions to: /var/www/~omibit/repos/alex/frame/tests/framesite/_first-app/code/view/dropdown/DropDown.js\n");
		?><!-- This will render one item in the drop down list
	The "qArgs" attribute specifies the attributes that should be setup in PHP for this template's render method 
	The "itemValue" attribute is copied to the "qbValue" attribute when an element in the list is clicked/selected
-->
<div class="item" qArgs="\QIModel $item" jsFunc="renderItem($item)" itemValue="<?= htmlspecialchars($item->getBindValue()); ?>">
	<?php $this->renderItemCaption($item); ?>
</div><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	public function generatedInit()
	{

	}

	/**
	 * @api.enable
	 */
	public function renderOptions($filter, $data = null)
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~omibit/repos/alex/frame/tests/framesite/_first-app/code/view/dropdown/DropDown.options.tpl", "Generating (1) JS Functions to: /var/www/~omibit/repos/alex/frame/tests/framesite/_first-app/code/view/dropdown/DropDown.js\n");
		?><!-- renders the drop down options with or without a filter 
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
</div><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}

	/**
	 * @api.enable
	 */
	public function render($value = null, \QIModel $selectedItem = null, $qb = null)
	{
				$this->includeJsClass();
if (\QWebRequest::IsAjaxCallback())
		{
			$this->renderAjaxStart();
			if (!$this->changed)
				return;
		}
		if (\QAutoload::$DebugPanel) $this->renderDebugInfo("/var/www/~omibit/repos/alex/frame/tests/framesite/_first-app/code/view/dropdown/DropDown.tpl", "Generating (1) JS Functions to: /var/www/~omibit/repos/alex/frame/tests/framesite/_first-app/code/view/dropdown/DropDown.js\n");
		?><!-- The main render for the Drop Down -->
<div qArgs="$value = null, \QIModel $selectedItem = null, $qb = null" class="dropDownCtrl QWebControl" jsFunc="render(\$value, $selectedItem, \$qb)" qCtrl="<?=$this->name."(".get_class($this).")"?>">
	<?php
		$value = $value ? $value : $this->value;
		$selectedItem = $selectedItem ? $selectedItem : $this->selectedItem;
		$qb = $qb ? $qb : $this->qb;
		
	?>
	<input class="hidden-value" type="hidden" <?= $qb ? "qb=\"{$qb}\"" : "" ?> <?= 
				$selectedItem ? "qbValue='".$selectedItem->getBindValue()."'" : "" ?> />
	<div class="selected">
		<div class="caption"><?= $selectedItem ? $this->renderItemCaption($selectedItem) : "<i>Not selected</i>" ?></div>
		<div class="icon"><i class="fa fa-arrow-circle-down"></i></div>
	</div>
	<div class="hidden-container">
		<input type="text" />
		<div class="options-container">
			<?php /* $this->renderOptions(); */ // we only load on demand ?>
		</div>
	</div>
</div><?php
		if (\QWebRequest::IsAjaxCallback())
			$this->renderAjaxEnd();
	}
}


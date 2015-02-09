<!-- The main render for the Drop Down -->
<div qArgs="$value = null, \QIModel $selectedItem = null, $qb = null" class="dropDownCtrl" jsFunc="render(\$value, $selectedItem, \$qb)">
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
</div>
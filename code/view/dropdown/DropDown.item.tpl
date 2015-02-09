<!-- This will render one item in the drop down list
	The "qArgs" attribute specifies the attributes that should be setup in PHP for this template's render method 
	The "itemValue" attribute is copied to the "qbValue" attribute when an element in the list is clicked/selected
-->
<div class="item" qArgs="\QIModel $item" jsFunc="renderItem($item)" itemValue="<?= htmlspecialchars($item->getBindValue()); ?>">
	<?php $this->renderItemCaption($item); ?>
</div>
/**
 * This is the Web Control definition in Javascript
 * Name of the control: MyCompany\\Util\\View\\DropDown
 * Extends: QWebControl
 * 
 * This inheritance is very close to what you would expect from standard OO
 * To call parent::FunctionName(), you will use: this._super()
 * 
 * The creation of a class' prototype may be async if it's parent (and all parents above) are not loaded yet.
 * QExtendClass will make sure all dependencies are loaded when we create the class' definition.
 */
QExtendClass("MyCompany\\Util\\View\\DropDown", "QWebControl",
{
	/**
	 * __ClassLoaded will be called after the CLASS is defined
	 */
	__ClassLoaded: function()
	{
		jQuery(document).click(function (e)
		{
			if (!jQuery(e.target).is(".dropDownCtrl *, .dropDownCtrl"))
				jQuery(".dropDownCtrl .hidden-container").hide();
		});

		jQuery(document).on("click", ".dropDownCtrl .selected", function ()
		{
			var dd = jQuery(this).closest(".dropDownCtrl");
			var hidden = dd.find(".hidden-container");
			jQuery(".dropDownCtrl .hidden-container").not(hidden).hide();
			hidden.toggle();

			var input = dd.find("input");
			input.off('keyup').keyup(function() {
				$ctrl(hidden).loadResults();
			});

			if (hidden.is(":visible"))
				$ctrl(hidden).loadResults();
		});
	},
	
	/**
	 * You may add static properties and functions here
	 */
	__static: {
		
	},
	
	/**
	 * We call this method when we click/select an item in the drop/down
	 * 
	 * @param {DomElement} item
	 */
	selectItem: function(item)
	{
		var caption = jQuery(item).html();
		this.jQuery(".caption").html(caption);
		if (this.jQuery(".hidden-value").attr("qb"))
			this.jQuery(".hidden-value").attr("qbValue", jQuery(item).attr("itemValue"));
	},
	
	/**
	 * We call loadResults when we open the options box or when we search on the input
	 */
	loadResults: function()
	{
		var filter = this.jQuery(".hidden-container > input[type=text]").val();
		var ref_this = this;
		
		this.call("renderOptions", [filter], function (opts_html)
		{
			ref_this.jQuery(".hidden-container .options-container").html(opts_html);
			ref_this.jQuery(".hidden-container .item").off('click').click(function() {
				ref_this.selectItem(this);
				ref_this.jQuery(".hidden-container").hide();
			});
		});
	}
});

// ONLY GENERATED CODE FROM HERE

/** Begin :: Generated function: MyCompany\Util\View\DropDown::render **/
QExtendClass("MyCompany\\Util\\View\\DropDown", "QWebControl", {
render: function($value, $selectedItem, $qb)
{

		var $_QOUT = "";

$_QOUT += "<div qArgs=\"$value = null, \\QIModel $selectedItem = null, $qb = null\" class=\"dropDownCtrl QWebControl\" jsFunc=\"render(\\$value, $selectedItem, \\$qb)\" qCtrl=\"" + (this.name+ "" +"("+ "" +get_class(this)+ "" +")") + "\">\n" + 
			"	";		$value = $value ? $value : this.value;
		$selectedItem = $selectedItem ? $selectedItem : this.selectedItem;
		$qb = $qb ? $qb : this.qb;
		
	$_QOUT += "	<input class=\"hidden-value\" type=\"hidden\" " + ( $qb ? "qb=\"" + $qb + "\"" : "" ) + " " + ( 
				$selectedItem ? "qbValue='"+ "" +$selectedItem.getBindValue()+ "" +"'" : "" ) + " />\n" + 
			"	<div class=\"selected\">\n" + 
			"		<div class=\"caption\">" + ( $selectedItem ? this.renderItemCaption($selectedItem) : "<i>Not selected</i>" ) + "</div>\n" + 
			"		<div class=\"icon\"><i class=\"fa fa-arrow-circle-down\"></i></div>\n" + 
			"	</div>\n" + 
			"	<div class=\"hidden-container\">\n" + 
			"		<input type=\"text\" />\n" + 
			"		<div class=\"options-container\">\n" + 
			"			";/* $this->renderOptions(); */ // we only load on demand $_QOUT += "		</div>\n" + 
			"	</div>\n" + 
			"</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Util\View\DropDown::render **/



/** Begin :: Generated function: MyCompany\Util\View\DropDown::renderOptions **/
QExtendClass("MyCompany\\Util\\View\\DropDown", "QWebControl", {
renderOptions: function($filter, $data)
{

		var $_QOUT = "";

$_QOUT += "<div qArgs=\"$filter, $data = null\" jsFunc=\"renderOptions($filter, $data)\">\n" + 
			"	";		// if the filter is array then we assume that is the actual data
		$filter = qis_array($filter) ? null : $filter;
		// if no data, we query for it based on the filter
		$data = qis_array($filter) ? $filter : ($data ? $data : this.getData($filter));
		
		if (!$data) {
			$_QOUT += "<i>No Results</i>";		}
		else {
			var $_expr_item = $data ;
if ($_expr_item._ty && ($_expr_item._ty === 'QModelArray'))
	$_expr_item = $_expr_item._items;
var $_isArr_item = Array.isArray($_expr_item);
for (var $_key_item in $_expr_item)
{

		if ($_isArr_item && (!(($_key_item >=0) && ($_key_item < $_expr_item.length))))
			continue;
		$item = $_expr_item[$_key_item];
this.renderItem($item);
}

		}
	$_QOUT += "</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Util\View\DropDown::renderOptions **/



/** Begin :: Generated function: MyCompany\Util\View\DropDown::renderItem **/
QExtendClass("MyCompany\\Util\\View\\DropDown", "QWebControl", {
renderItem: function($item)
{

		var $_QOUT = "";

$_QOUT += "<div class=\"item\" qArgs=\"\\QIModel $item\" jsFunc=\"renderItem($item)\" itemValue=\"" + ( htmlspecialchars($item.getBindValue()) ) + "\">\n" + 
			"	";this.renderItemCaption($item); $_QOUT += "</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\Util\View\DropDown::renderItem **/



/** Begin :: Generated function: MyCompany\DropDown::renderItem **/
QExtendClass("MyCompany\\DropDown", "", {
renderItem: function($item)
{

		var $_QOUT = "";

$_QOUT += "<div class=\"item\" qArgs=\"\\QIModel $item\" jsFunc=\"renderItem($item)\" itemValue=\"" + ( htmlspecialchars($item.getBindValue()) ) + "\">\n" + 
			"	";this.renderItemCaption($item); $_QOUT += "</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\DropDown::renderItem **/



/** Begin :: Generated function: MyCompany\DropDown::renderOptions **/
QExtendClass("MyCompany\\DropDown", "", {
renderOptions: function($filter, $data)
{

		var $_QOUT = "";

$_QOUT += "<div qArgs=\"$filter, $data = null\" jsFunc=\"renderOptions($filter, $data)\">\n" + 
			"	";		// if the filter is array then we assume that is the actual data
		$filter = qis_array($filter) ? null : $filter;
		// if no data, we query for it based on the filter
		$data = qis_array($filter) ? $filter : ($data ? $data : this.getData($filter));
		
		if (!$data) {
			$_QOUT += "<i>No Results</i>";		}
		else {
			var $_expr_item = $data ;
if ($_expr_item._ty && ($_expr_item._ty === 'QModelArray'))
	$_expr_item = $_expr_item._items;
var $_isArr_item = Array.isArray($_expr_item);
for (var $_key_item in $_expr_item)
{

		if ($_isArr_item && (!(($_key_item >=0) && ($_key_item < $_expr_item.length))))
			continue;
		$item = $_expr_item[$_key_item];
this.renderItem($item);
}

		}
	$_QOUT += "</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\DropDown::renderOptions **/



/** Begin :: Generated function: MyCompany\DropDown::render **/
QExtendClass("MyCompany\\DropDown", "", {
render: function($value, $selectedItem, $qb)
{

		var $_QOUT = "";

$_QOUT += "<div qArgs=\"$value = null, \\QIModel $selectedItem = null, $qb = null\" class=dropDownCtrl QWebControl jsFunc=\"render(\\$value, $selectedItem, \\$qb)\" qCtrl=\"" + (this.name+ "" +"("+ "" +get_class(this)+ "" +")") + "\">\n" + 
			"	";		$value = $value ? $value : this.value;
		$selectedItem = $selectedItem ? $selectedItem : this.selectedItem;
		$qb = $qb ? $qb : this.qb;
		
	$_QOUT += "	<input class=\"hidden-value\" type=\"hidden\" " + ( $qb ? "qb=\"" + $qb + "\"" : "" ) + " " + ( 
				$selectedItem ? "qbValue='"+ "" +$selectedItem.getBindValue()+ "" +"'" : "" ) + " />\n" + 
			"	<div class=\"selected\">\n" + 
			"		<div class=\"caption\">" + ( $selectedItem ? this.renderItemCaption($selectedItem) : "<i>Not selected</i>" ) + "</div>\n" + 
			"		<div class=\"icon\"><i class=\"fa fa-arrow-circle-down\"></i></div>\n" + 
			"	</div>\n" + 
			"	<div class=\"hidden-container\">\n" + 
			"		<input type=\"text\" />\n" + 
			"		<div class=\"options-container\">\n" + 
			"			";/* $this->renderOptions(); */ // we only load on demand $_QOUT += "		</div>\n" + 
			"	</div>\n" + 
			"</div>";
		return $_QOUT;
}});

/** End :: Generated function: MyCompany\DropDown::render **/


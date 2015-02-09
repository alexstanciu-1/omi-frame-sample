
function createModal(content)
{
	var jq = jQuery("<div class=\"qBoxWrap QWebControl\" qCtrl=\"(MyCompany\\Ecomm\\View\\OrderCtrl)\">\
		<div class=\"qBoxOverlay\">\
			&nbsp;\
		</div>\
		<div class=\"vertical-offset\">\
			<div class=\"qBox\">" +
				content + "\
			</div>\
			<a class='close'>X</a>\
		</div>\
	</div>");
	
	jq.find(".close, .qBoxOverlay").click(function ()
	{
		jq.remove();
	});
	
	jQuery(document.body).append(jq);
	
	return jq;
}



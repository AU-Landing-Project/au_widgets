//
// updates the widget configuration form with the required
// number of fields
function tabtext_update_form(widgetguid){
	var throbber = '<img src="<?php echo elgg_get_site_url() . "_graphics/ajax_loader.gif"; ?>">';
	
	var numtabs = $("#numtabs"+widgetguid).val();
	
	$("#tabtext_widget_form_"+widgetguid).html(throbber);

	elgg.get("<?php echo elgg_get_site_url() . 'ajax/view/forms/tabtext' ?>", {
		tabtext_widget_guid: widgetguid,
		tabtext_numtabs: numtabs
	}).done( function(data){
		$("#tabtext_widget_form_"+widgetguid).html(data);
	});
}


//
// updates the widget content with the required
// content depending on the tab
function tabtext_update_content(widgetguid, tabnum){
	var throbber = '<img src="<?php echo elgg_get_site_url() . "_graphics/ajax_loader.gif"; ?>">';
	
	$("#tabtext_content_"+widgetguid).html(throbber);

	elgg.get("<?php echo elgg_get_site_url() . 'ajax/view/tabtext/content' ?>", {
		tabtext_widget_guid: widgetguid,
		tabtext_contentnum: tabnum
	}).done( function(data){
		$("#tabtext_content_"+widgetguid).html(data);
	});
}
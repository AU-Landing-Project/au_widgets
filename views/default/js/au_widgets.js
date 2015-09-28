define(['require', 'jquery', 'elgg'], function(require, $, elgg) {

    // trigger update of selected view
    $(document).on('change', '.eligo-update-selected', function(e) {
       var guid = $(this).parents('form').first().find('input[name="guid"]').val(); 
       
       eligo_update_selected(guid);
    });
    
    $(document).on('click', '.eligo_selectsort input[type=radio]', function(e) {
        var guid = $(this).parents('form').first().find('input[name="guid"]').val(); 
        if ($("#eligo_displayby_select_"+guid+" option:selected").val() === 'selected') {
            eligo_update_selected(guid);
	}
    });
    
    $(document).on('change', '.eligo-owners, .eligo-tagfilter-andor', function(e) {
        var guid = $(this).parents('form').first().find('input[name="guid"]').val(); 
        if ($("#eligo_displayby_select_"+guid+" option:selected").val() === 'selected') {
            eligo_update_selected(guid);
	}
    });
    
    $(document).on('keyup', '.eligo-tagfilter', function(e) {
        var guid = $(this).parents('form').first().find('input[name="guid"]').val();
        if ($("#eligo_displayby_select_"+guid+" option:selected").val() === 'selected') {
            eligo_update_selected(guid);
	}
    });
    
    
    // tabtext UI
    $(document).on('click', '.tabtext-tab', function(e) {
        e.preventDefault();
        var guid = $(this).attr('data-guid');
        
        $(this).parents('ul').first().children().removeClass('elgg-state-selected');
        $(this).parent().addClass('elgg-state-selected');
        
        var throbber = '<div class="elgg-ajax-loader"></div>';
        var tabnum = $(this).attr('data-tab');
	
	$("#tabtext_content_" + guid).html(throbber);

	elgg.get(elgg.get_site_url() + 'ajax/view/tabtext/content', {
		tabtext_widget_guid: guid,
		tabtext_contentnum: tabnum
	}).done( function(data){
		$("#tabtext_content_" + guid).html(data);
	});
    });

    
    // init custom date pickers
    $(document).on('focus', '.eligo-datepicker', function(e) {
       $(this).datepicker({
            inline: true
        }); 
    });

    var eligo_update_selected = function(guid) {
        var throbber = '<div class="elgg-ajax-loader"></div>';
        var eligo_owners = $("#eligo_owners_" + guid + " option:selected").val();
        var eligo_displayby = $("#eligo-displayby-select-" + guid + " option:selected").val();
        var eligo_selectsort = $("#eligo-displayby-" + guid + " input[type=radio]:checked").val();
        var eligo_tagfilter = $("#eligo_tagfilter" + guid).val();
        var eligo_tagfilter_andor = $("#eligo_tagfilter_andor" + guid + " option:selected").val();
        
        $("#eligo-displayby-" + guid).html(throbber);
        
        elgg.get(elgg.get_site_url() + "ajax/view/eligo/displayby/options", {
            guid: guid,
            eligo_owners: eligo_owners,
            eligo_displayby: eligo_displayby,
            eligo_select_sort: eligo_selectsort,
            eligo_tagfilter: eligo_tagfilter,
            eligo_tagfilter_andor: eligo_tagfilter_andor
        }).done(function(data) {
            $("#eligo-displayby-" + guid).html(data);
        });
    };

});
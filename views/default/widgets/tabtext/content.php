<?php

$widget = $vars['entity'];

// create tabs
$tabs = array();
for($i=1; $i<6; $i++){
  $tabfield = "title{$i}";
  if(!empty($widget->$tabfield)){
    $tabs[] = array('title' => elgg_view('output/text', array('value' => $widget->$tabfield)), 'url' => 'javascript:void(0);', 'selected' => $i == 1 ? TRUE : FALSE, 'id' => $tabfield.$widget->guid);
  }
}


// create a string of ids for jquery selectors
$jquery_selectors = "";
for($i=0; $i<count($tabs); $i++){
  $jquery_selectors .= ($i != 0) ? ", " : "";
  $jquery_selectors .= "#".$tabs[$i]['id'];
}

// output the tabs
echo elgg_view('navigation/tabs', array('tabs' => $tabs));
$content = elgg_view('tabtext/content', array('entity' => $widget));
?>

<div id="tabtext_content_<?php echo $widget->guid; ?>">
	<?php echo $content ? $content : elgg_echo('tabtext:no:content'); ?>
</div>

<script>
$(document).ready(function() {
	$("<?php echo $jquery_selectors; ?>").click(function() {
		$("<?php echo $jquery_selectors; ?>").removeClass("elgg-state-selected");
		$(this).addClass("elgg-state-selected");
		var id = $(this).attr('id');
		
		tabtext_update_content(<?php echo $widget->guid; ?>, id[5]);
	});
  
});
</script>


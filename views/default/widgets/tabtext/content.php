<?php

namespace AU\Widgets;

$widget = $vars['entity'];

// create tabs
$tabs = array();
for ($i = 1; $i < 6; $i++) {
	$tabfield = "title{$i}";
	if (!empty($widget->$tabfield)) {
		$tabs[] = array(
			'title' => elgg_view('output/text', array(
				'value' => $widget->$tabfield
			)),
			'url' => '#',
			'selected' => $i == 1 ? TRUE : FALSE,
			'id' => $tabfield . $widget->guid,
			'link_class' => 'tabtext-tab',
			'data-guid' => $widget->guid,
			'data-tab' => $i
		);
	}
}


// create a string of ids for jquery selectors
$jquery_selectors = "";
for ($i = 0; $i < count($tabs); $i++) {
	$jquery_selectors .= ($i != 0) ? ", " : "";
	$jquery_selectors .= "#" . $tabs[$i]['id'];
}

// output the tabs
echo elgg_view('navigation/tabs', array('tabs' => $tabs));
$content = elgg_view('tabtext/content', array('entity' => $widget));
?>

<div id="tabtext_content_<?php echo $widget->guid; ?>">
	<?php echo $content ? $content : elgg_echo('tabtext:no:content'); ?>
</div>


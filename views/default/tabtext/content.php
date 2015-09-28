<?php

namespace AU\Widgets;

// inputs used because this view can be accessed via ajax
$num = get_input('tabtext_contentnum', 1);
$guid = get_input('tabtext_widget_guid', $vars['entity']->guid);

$widget = get_entity($guid);

// sanity check
if ($widget instanceof \ElggWidget && is_numeric($num) && $num > 0) {
	$attribute = "description{$num}";
	$nofilter = elgg_get_plugin_setting('nofilter', PLUGIN_ID);
	if ($nofilter != 'no') {
		// outputting raw value as admins don't get filtered.
		// Non-admins are filtered on input so we should be safe
		echo '<div class="elgg-output">' . $widget->$attribute . '</div>';
	} else {
		echo elgg_view('output/longtext', array('value' => $widget->$attribute));
	}
} else {
	echo elgg_echo('tabtext:invalid:parameters');
}
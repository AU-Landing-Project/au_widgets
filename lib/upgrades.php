<?php

namespace AU\Widgets;

function upgrade20150927() {
	$version = (int) elgg_get_plugin_setting('version', PLUGIN_ID);
	
	if ($version >= PLUGIN_VERSION) {
		return true;
	}
	
	elgg_set_plugin_setting('version', 20150927, PLUGIN_ID);
}
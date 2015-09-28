<?php

namespace AU\Widgets;

function upgrades() {
	if (!elgg_is_admin_logged_in()) {
		return true;
	}
	
	require_once __DIR__ . '/upgrades.php';
	
	run_function_once(__NAMESPACE__ . '\\upgrade20150927');
}
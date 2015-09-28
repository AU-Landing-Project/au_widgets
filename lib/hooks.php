<?php

namespace AU\Widgets;

/**
 * plugin hook handler called on action, widgets/save
 * serializes the array of selected entities
 * 
 * @param type $hook
 * @param type $type
 * @param type $returnvalue
 * @param type $params
 */
function widget_save_selected($hook, $type, $return, $params) {
	$guid = get_input('guid');

	$widget = get_entity($guid);

	if ($widget instanceof \ElggWidget) {

		$entitylist = get_input('eligo_selected_entities');

		if (is_array($entitylist)) {
			$widget->eligo_selected_entities = serialize($entitylist);
		}
	}

	return $return;
}


/**
 * admin widget settings save for tabtext
 * 
 * @param type $hook
 * @param type $type
 * @param type $returnvalue
 * @param type $params
 * @return boolean
 */
function tabtext_save_settings($hook, $type, $return, $params) {
	$nofilter = elgg_get_plugin_setting('nofilter', 'tabtext');
	if (!elgg_is_admin_logged_in() || $nofilter == 'no') {
		return $return;
	}
	
	$widget = $params['widget'];
	$params = get_input('params', '', false);

	if (is_array($params) && count($params) > 0) {
		foreach ($params as $name => $value) {
			if (is_array($value)) {
				// private settings cannot handle arrays
				return false;
			} else {
				$widget->$name = $value;
			}
		}
		$widget->save();
	}

	return true;
}

<?php

namespace AU\Widgets;

$widget = $vars['entity'];
if (empty($widget->eligo_type) || empty($widget->eligo_subtype)) {
	$ia = elgg_set_ignore_access(true);
	$widget->eligo_type = 'group';
	// groups don't have a subtype
	//$widget->eligo_subtype = '';
	// if this is an existing widget from the old 1.7 version
	// we provide an upgrade path for settings... hopefully  :)
	// this can be removed to save a few cycles if it's a new installation
	$widget = eligo_upgrade_old_widget($widget);

	// we don't limit groups by owner, just our membership and other factors
	$widget->eligo_owners = 'all';

	// we provide custom options for the select option
	// as we need to do it by relationship
	$widget->eligo_custom_select_options = 'eligo_groups_select_options';

	//set custom title attribute (groups use name instead of title)
	$widget->eligo_select_option_title = 'name';
	elgg_set_ignore_access($ia);
}

// now we can get our content
$options = eligo_get_display_entities_options($widget);

// a few adjustments for groups
$options['relationship'] = 'member';
$options['relationship_guid'] = $widget->owner_guid;

$content = elgg_list_entities_from_relationship($options);

echo $content;

if ($content) {
	$user = elgg_get_page_owner_entity();

	if ($user instanceof \ElggUser) {
		$url = "groups/member/" . $user->username;
		$more_link = elgg_view('output/url', array(
			'href' => $url,
			'text' => elgg_echo('groups:more'),
			'is_trusted' => true,
		));
		echo "<span class=\"elgg-widget-more\">$more_link</span>";
	}
} else {
	echo elgg_echo('groups:none');
}

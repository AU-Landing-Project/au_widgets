<?php

namespace AU\Widgets;

$widget = $vars['entity'];
if (empty($widget->eligo_type) || empty($widget->eligo_subtype)) {
	$ia = elgg_set_ignore_access(true);
	$widget->eligo_type = 'object';
	$widget->eligo_subtype = 'blog';

	// if this is an existing widget from the old 1.7 version
	// we provide an upgrade path for settings... hopefully  :)
	// this can be removed to save a few cycles if it's a new installation
	$widget = eligo_upgrade_old_widget($widget);
	elgg_set_ignore_access($ia);
}

// add in a create content link in certain contexts
$owner = elgg_get_page_owner_entity();
if (elgg_get_logged_in_user_guid() == $owner->guid || (elgg_instanceof($owner, 'group') && $owner->isMember())) {

	if (($owner instanceof \ElggGroup) && $owner->blog_enable != 'yes') {
		// dont show a link
	} else {
		$url = 'blog/add/' . $owner->guid;

		echo '<div class="au_widgets_add_content">';
		echo elgg_view('output/url', array(
			'href' => $url,
			'text' => elgg_echo('blog:add'),
			'is_trusted' => TRUE,
		));
		echo '</div>';
	}
}

// now we can get our content
$options = eligo_get_display_entities_options($widget);
$content = elgg_list_entities($options);


echo $content;

if ($content) {
	$blog_url = "blog/owner/" . elgg_get_page_owner_entity()->username;
	if (elgg_instanceof(elgg_get_page_owner_entity(), 'group')) {
		$blog_url = "blog/group/" . elgg_get_page_owner_entity()->guid . "/all";
	}

	$more_link = elgg_view('output/url', array(
		'href' => $blog_url,
		'text' => elgg_echo('blog:moreblogs'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('blog:noblogs');
}

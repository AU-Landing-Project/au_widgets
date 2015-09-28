<?php

namespace AU\Widgets;

const PLUGIN_ID = 'au_widgets';
const PLUGIN_VERSION = 20150927;

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

require_once __DIR__ . '/lib/functions.php';
require_once __DIR__ . '/lib/events.php';
require_once __DIR__ . '/lib/hooks.php';


function init() {
	// add in our own css
	elgg_extend_view('css/elgg', 'css/au_widgets');

	elgg_extend_view('object/widget', 'object/widget/au_widgets');

	// make some views accessible by ajax
	elgg_register_ajax_view('eligo/displayby/options');

	// hook into the widget save action
	// so we can manually save a serialized array
	elgg_register_plugin_hook_handler('action', 'widgets/save', __NAMESPACE__ . '\\widget_save_selected');

	//register the tag tracker
	elgg_register_widget_type('au_tagtracker', elgg_echo('au_tagtracker'), elgg_echo('au_tagtracker:description'), array(
		'all',
		'index'
	), TRUE);


	//register the random content widget
	elgg_register_widget_type('au_random_content', elgg_echo('au_random_content'), elgg_echo('au_random_content:widget:description'), array(
		'all',
		'index'
	), TRUE);

	//register the pages widget
	if (elgg_is_active_plugin('pages')) {
		elgg_unregister_widget_type('pages');
		elgg_register_widget_type('pages', elgg_echo('pages'), elgg_echo('pages:widget:description'), array('all'), TRUE);
	}

	//register the files widget
	if (elgg_is_active_plugin('file')) {
		elgg_unregister_widget_type("filerepo");
		elgg_register_widget_type('filerepo', elgg_echo("file"), elgg_echo("file:widget:description"), array(
			'all',
			'index'
		), TRUE);
	}

	//register	the bookmarks widget
	if (elgg_is_active_plugin('bookmarks')) {
		elgg_unregister_widget_type('bookmarks');
		elgg_register_widget_type('bookmarks', elgg_echo('bookmarks'), elgg_echo('bookmarks:widget:description'), array(
			'all',
			'index'
		), TRUE);
	}

	//register the blog widget
	if (elgg_is_active_plugin('blog')) {
		elgg_unregister_widget_type('blog');
		elgg_register_widget_type('blog', elgg_echo('blog'), elgg_echo('blog:widget:description'), array(
			'all',
			'index'
		), TRUE);
	}

	//register the group member river widget
	elgg_register_widget_type('groupmemberriver', elgg_echo('groupmemberriver:widget:title'), elgg_echo('groupmemberriver:widget:description'), array(
		'groups'
	), TRUE);

	// register our widget
	elgg_register_widget_type('tabtext', elgg_echo('tabtext'), elgg_echo('tabtext:description'), array(
		'all',
		'index'
	), TRUE);

	// custom save our content without filtering if allowed and admin
	elgg_register_plugin_hook_handler('widget_settings', 'tabtext', __NAMESPACE__ . '\\tabtext_save_settings');

	//register liked content widget
	elgg_register_widget_type(
		'liked_content', elgg_echo('liked_content:widget:your_likes:title'), elgg_echo('liked_content:widget:your_likes:description'), array(
			'all',
			'index'
		), TRUE);
	
	// make some views accessible by ajax
	elgg_register_ajax_view('forms/tabtext');
	elgg_register_ajax_view('tabtext/content');
	
	elgg_register_event_handler('upgrade', 'system', __NAMESPACE__ . '\\upgrades');
}


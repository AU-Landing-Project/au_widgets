<?php

/**
 * 
 * Provides reuseable code/views for eligo aware widgets
 */

include 'lib/functions.php';

function eligo_framework_init(){
  // add in our own css
  elgg_extend_view('css/elgg', 'eligo/css');
  
  // add in our own js
  elgg_extend_view('js/elgg', 'js/eligo');
  
  // make some views accessible by ajax
  elgg_register_ajax_view('eligo/displayby/options');
  
  // hook into the widget save action
  // so we can manually save a serialized array
  elgg_register_plugin_hook_handler('action', 'widgets/save', 'eligo_widget_save_selected');

//register the tag tracker
	elgg_register_widget_type('au_tagtracker', elgg_echo('au_tagtracker'), elgg_echo('au_tagtracker:description'), 'index,profile,dashboard,groups', TRUE); 
	
	
//register the random content widget
	elgg_register_widget_type('au_random_content', elgg_echo('au_random_content'), elgg_echo('au_random_content:widget:description'), 'all,groups,index', TRUE);	
//register the pages widget

	elgg_unregister_widget_type('pages');
	elgg_register_widget_type('pages', elgg_echo('pages'), elgg_echo('pages:widget:description'), 'profile,dashboard,index,groups', TRUE);

//register the files widget
	elgg_unregister_widget_type("filerepo");
	elgg_register_widget_type('filerepo', elgg_echo("file"), elgg_echo("file:widget:description"), 'profile,dashboard,index,groups', TRUE);

//register	the bookmarks widget
  elgg_unregister_widget_type('bookmarks');
  elgg_register_widget_type('bookmarks', elgg_echo('bookmarks'), elgg_echo('bookmarks:widget:description'), 'profile,dashboard,index,groups', TRUE);

//register the blog widget
  elgg_unregister_widget_type('blog');
  elgg_register_widget_type('blog', elgg_echo('blog'), elgg_echo('blog:widget:description'), 'profile,dashboard,index,groups', TRUE);

//register the group member river widget
	elgg_register_widget_type('groupmemberriver', elgg_echo('groupmemberriver:widget:title'), elgg_echo('groupmemberriver:widget:description'), "groups", TRUE);

//initialize the tabtext widget
  // include our css
  elgg_extend_view('css/elgg', 'tabtext/css');
  
  //add in our js
  elgg_extend_view('js/elgg', 'tabtext/js');
  
  // register our widget
  elgg_register_widget_type('tabtext', elgg_echo('tabtext'), elgg_echo('tabtext:description'), 'profile,dashboard,groups,index', TRUE);

  // make some views accessible by ajax
  elgg_register_ajax_view('forms/tabtext');
  elgg_register_ajax_view('tabtext/content');
  
  // custom save our content without filtering if allowed and admin
  $nofilter = elgg_get_plugin_setting('nofilter', 'tabtext');
  if(elgg_is_admin_logged_in() && $nofilter != 'no'){
    elgg_register_plugin_hook_handler('widget_settings', 'tabtext', 'tabtext_save_settings');
  }
	
	//register liked content widget
		elgg_register_widget_type(
		  'liked_content',
		  elgg_echo('liked_content:widget:your_likes:title'),
		  elgg_echo('liked_content:widget:your_likes:description'),
		  'profile,dashboard,groups,index',
		  TRUE
	);	
}



// custom select
// we need to make sure that tags are entered, or we invalidate it
function au_tagtracker_custom_select($widget, $vars, $options){
  // get based on tags
  // priority goes to $vars as it's ajax populated, then saved $widget
  $tags = $vars['eligo_tagfilter'] ? $vars['eligo_tagfilter'] : FALSE;
  if(!$tags){
    $tags = $widget->eligo_tagfilter ? $widget->eligo_tagfilter : '';
  }
  
  if(empty($tags)){
    // invalidate the query
    $options['subtypes'] = array('eligo_invalidate_query');
  }
  
  return $options;
}


// function for the group widget

// custom options for select
function eligo_groups_select_options($widget, $vars){
  $options = array();
  
  // have to get the users groups here, because it requires relationship
  // not the most efficient, but fits better with the framework
  $user = get_user($widget->owner_guid);
    
  $groups = $user->getGroups('',ELGG_ENTITIES_NO_VALUE,0);
  
  $group_guids = array();
  foreach($groups as $group){
    $group_guids[] = $group->guid;
  }
  
  // if we have any groups, use guids in options
  // otherwise invalidate the query
  if(count($group_guids) > 0){
    $options['guids'] = $group_guids;
  }
  else{
    $options['subtypes'] = array('eligo_invalidate_query');
  }
	
  // determine sort-by
  $sort = $vars['eligo_select_sort'] ? $vars['eligo_select_sort'] : FALSE;
  if(!$sort){
	$sort = $widget->eligo_select_sort ? $widget->eligo_select_sort : 'date';
  }
	
  if ($sort == "name"){
    // join to objects_entity table to sort by title in sql
	$join = "JOIN " . elgg_get_config('dbprefix') . "groups_entity o ON o.guid = e.guid";
	$options['joins'] = array($join);
	$options['order_by'] = 'o.name ASC';
  }

	
  return $options;
}

// admin widget settings save for tabtext
function tabtext_save_settings($hook, $type, $returnvalue, $params){
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
  
  return TRUE;
}

elgg_register_event_handler('init', 'system', 'eligo_framework_init');
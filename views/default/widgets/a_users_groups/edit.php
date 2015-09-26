<?php

// eligo_type should equal the object subtype
// used in elgg_get_entities()
$widget = $vars['entity'];
if(empty($widget->eligo_type) || empty($widget->eligo_subtype)){
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

// use sort by controls
echo elgg_view('eligo/sortby', $vars);

// display parameters: date range/selected/number
echo elgg_view('eligo/displayby', $vars);

// how many results to show?
echo elgg_view('eligo/number', $vars);

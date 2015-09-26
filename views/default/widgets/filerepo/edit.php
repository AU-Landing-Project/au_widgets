<?php

// eligo_type should equal the object subtype
// used in elgg_get_entities()
$widget = $vars['entity'];
if(empty($widget->eligo_type) || empty($widget->eligo_subtype)){
  $ia = elgg_set_ignore_access(true);
  $widget->eligo_type = 'object';
  $widget->eligo_subtype = 'file';
  
  // if this is an existing widget from the old 1.7 version
  // we provide an upgrade path for settings... hopefully  :)
  // this can be removed to save a few cycles if it's a new installation
  $widget = eligo_upgrade_old_widget($widget);
  elgg_set_ignore_access($ia);
}

// use sort by controls
echo elgg_view('eligo/sortby', $vars);

// use owner controls
if($vars['entity']->getContext() == "groups"){
  echo elgg_view('eligo/groupowners', $vars);
}
else{
  echo elgg_view('eligo/owners', $vars);
}

// display parameters: date range/selected/number
echo elgg_view('eligo/displayby', $vars);

// how many results to show?
echo elgg_view('eligo/number', $vars);

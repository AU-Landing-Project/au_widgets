<?php

// eligo_type should equal the object subtype
// used in elgg_get_entities()
$widget = $vars['entity'];

if(!$widget->eligo_type){
  $widget->eligo_type = 'object';
  $widget->eligo_custom_select_options = 'au_tagtracker_custom_select';
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

// filter by tags
echo elgg_view('eligo/tagfilter', $vars);

// how many results to show?
echo elgg_view('eligo/number', $vars);

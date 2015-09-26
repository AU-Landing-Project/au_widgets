<?php

$widget = $vars['entity'];

// for compatibility with old tagtracker
if (!$widget->num_display) {
  $widget->num_display = $widget->tagtrack_count ? $widget->tagtrack_count : 10;
  $widget->save();
}

// since we are relying on tags, and not filtering by
// subtype, we need to make sure that
// there are actually tags to use, otherwise output nothing

if(!empty($widget->eligo_tagfilter)){
  $options = eligo_get_display_entities_options($widget);
  $content = elgg_list_entities_from_metadata($options);
//  echo "<pre>" . print_r($options,1) . "</pre>";
}
else{
  $content = elgg_echo('au_tagtracker:enter:tags');
}

if(!$content){
  $content = elgg_echo('au_tagtracker:no:results');  
}

echo $content;

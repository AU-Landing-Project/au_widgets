<?php

$widget = $vars['entity'];
liked_content_set_defaults($widget);

$container = $widget->getContainerEntity();

$options = eligo_get_display_entities_options($widget);

$options['annotation_names'] = array('likes');

if (elgg_instanceof($container, 'user') && $widget->my_likes !== "0") {
  $options['annotation_owner_guids'] = $container->guid;
}

if (!elgg_instanceof($container, 'user') && !elgg_instanceof($container, 'group')) {
  unset($options['container_guids']);
}


if ($widget->eligo_sortby == 'mostliked') {
  $dbprefix = elgg_get_config('dbprefix');
  $likes_metastring = get_metastring_id('likes');
  $options['selects'] = array("(SELECT count(distinct l.id) FROM {$dbprefix}annotations l WHERE l.name_id = $likes_metastring AND l.entity_guid = e.guid) AS likes");
  
  $options['order_by'] = 'likes ASC';
  if ($widget->eligo_sortby_dir == 'desc') {
	$options['order_by'] = 'likes DESC';
  }
}

$context = elgg_get_context();
elgg_set_context('liked_content_widget');
$content = elgg_list_entities_from_annotations($options);
elgg_set_context($context);


if ($content) {
  echo $content;
}
else {
  echo elgg_echo('liked_content:noresults');
}

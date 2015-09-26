<?php
$widget = $vars['entity'];
liked_content_set_defaults($widget);

$container = $widget->getContainerEntity();


// show most liked content, or my liked content?
// note: can't sort by title as not all entities have a title
$vars['sortby_options'] = array(
	'mostliked' => elgg_echo('liked_content:most_liked'),
	'title' => '',
);

$options = array(
	'name' => 'params[my_likes]',
	'value' => 1
);

if ($widget->my_likes !== "0") {
  $options['checked'] = 'checked';
}

if (elgg_instanceof($container, 'user')) {
  echo elgg_view('input/checkbox', $options);
  echo elgg_echo('liked_content:widget:your_likes:mine');
  echo '<br><br>';
}

// use sort by controls
echo elgg_view('eligo/sortby', $vars);

// use owner controls
if(elgg_instanceof($container, 'group')){
  echo elgg_view('eligo/groupowners', $vars);
}
elseif(elgg_instanceof($container, 'user')){
  echo elgg_view('eligo/owners', $vars);
}

// how many results to show?
echo elgg_view('eligo/number', $vars);
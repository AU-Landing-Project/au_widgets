<?php

namespace AU\Widgets;

$widget = $vars["entity"];

// which activities to show?
$options = array(
	'name' => 'params[subset]',
	'value' => $widget->subset ? $widget->subset : 'justgroup',
	'options_values' => array(
		'all' => elgg_echo('groupmemberriver:option:all'),
		'justgroup' => elgg_echo('groupmemberriver:option:justgroup'),
		'notgroup' => elgg_echo('groupmemberriver:option:notgroup')
	),
);

echo elgg_echo("groupmemberriver:widget:settings:subset") . "<br>";
echo elgg_view('input/dropdown', $options) . "<br><br>";


// how many activities to show?
$options = array(
	'name' => 'params[activity_count]',
	'value' => $widget->activity_count ? $widget->activity_count : 10,
	'options' => range(1, 10),
);

echo elgg_echo('groupmemberriver:widget:settings:activity_count') . "<br>";
echo elgg_view('input/dropdown', $options) . "<br><br>";

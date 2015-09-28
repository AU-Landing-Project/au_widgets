<?php

namespace AU\Widgets;

/**
 * 
 * 	Generates the dropdown menus for displaying content
 */
$widget = $vars['entity'];
if ($widget->eligo_displayby == '') {
	$widget->eligo_displayby = 'recent';
}

echo '<div class="eligo_field">';

echo elgg_echo('eligo:displayby') . ":";

$options = array(
	'name' => 'params[eligo_displayby]',
	'value' => $widget->eligo_displayby,
	'id' => 'eligo-displayby-select-' . $widget->guid,
	'class' => 'eligo-update-selected',
	'data-guid' => $widget->guid,
	'options_values' => array(
		'recent' => elgg_echo('eligo:displayby:recent'),
		'date' => elgg_echo('eligo:displayby:date'),
		'selected' => elgg_echo('eligo:displayby:selected'),
	),
);

echo elgg_view('input/dropdown', $options);

echo "<div id=\"eligo-displayby-{$widget->guid}\" class=\"au-widget-subfield\">";
echo elgg_view('eligo/displayby/options', $vars);
echo "</div>"; // eligo_displayby_{$widget->guid}

echo "</div>"; // eligo_field

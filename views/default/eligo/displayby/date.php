<?php

namespace AU\Widgets;

/**
 * Range of dates to display
 */
$widget = $vars['entity'];

//
//    START DATE    //
//
echo '<div class="eligo_field">';

echo elgg_echo('eligo:displayby:date:from') . ":";


$options = array(
	'name' => 'params[eligo_date_from]',
	'value' => $widget->eligo_date_from,
	'id' => "eligo_date_from_" . $widget->guid,
	'class' => 'eligo-datepicker'
);

echo elgg_view('input/text', $options);

echo "</div>"; // eligo_field
//
//    END DATE    //
//
echo '<div class="eligo_field">';
echo elgg_echo('eligo:displayby:date:to') . ":";

$options = array(
	'name' => 'params[eligo_date_to]',
	'value' => $widget->eligo_date_to,
	'id' => "eligo_date_to_" . $widget->guid,
	'class' => 'eligo-datepicker'
);

echo elgg_view('input/text', $options);

echo "</div>"; // eligo_field

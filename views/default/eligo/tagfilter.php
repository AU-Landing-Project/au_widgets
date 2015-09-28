<?php

namespace AU\Widgets;

$widget = $vars['entity'];

$options = array(
	'name' => 'params[eligo_tagfilter]',
	'value' => $widget->eligo_tagfilter ? $widget->eligo_tagfilter : '',
	'id' => 'eligo_tagfilter' . $widget->guid,
	'class' => 'eligo-tagfilter'
);

echo "<div class=\"eligo_field\">";
echo elgg_echo('eligo:tagfilter:label') . "<br>";
echo elgg_view('input/text', $options);
echo "</div>"; // /eligo_field

/* apparently not used anymore?
$options = array(
	'name' => 'params[eligo_tagfilter_andor]',
	'value' => $widget->eligo_tagfilter_andor ? $widget->eligo_tagfilter_andor : 'and',
	'id' => 'eligo_tagfilter_andor' . $widget->guid,
	'class' => 'eligo-tagfilter-andor',
	'options_values' => array(
		'and' => elgg_echo('eligo:tagfilter:and'),
		'or' => elgg_echo('eligo:tagfilter:or'),
	),
);


echo "<div class=\"eligo_field\">";
echo elgg_echo('eligo:tagfilter_andor:label') . "<br>";
echo elgg_view('input/dropdown', $options);
echo "</div>"; // /eligo_field
*/
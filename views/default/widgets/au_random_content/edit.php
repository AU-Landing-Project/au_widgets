<?php

namespace AU\Widgets;

$widget = $vars['entity'];

// select types of content to include
$registered_entities = get_registered_entity_types();

$options_values = array();
foreach ($registered_entities['object'] as $subtype) {
	$options_values[elgg_echo($subtype)] = $subtype;
}

ksort($options_values, SORT_NATURAL | SORT_FLAG_CASE);

echo elgg_echo('au_random_content:show:types') . "<br>";

foreach ($options_values as $label => $subtype) {
	$options = array(
		'name' => "params[subtype_$subtype]",
		'value' => 1
	);

	$attribute = 'subtype_' . $subtype;
	if ($widget->$attribute) {
		$options['checked'] = 'checked';
	}

	echo elgg_view('input/checkbox', $options);
	echo $label;
	echo "<br>";
}


// how recent should the items be?
echo "<br>";
echo elgg_echo('au_random_content:mintime') . '<br>';
echo elgg_view('input/text', array(
	'name' => 'params[mintime]',
	'value' => $widget->mintime ? $widget->mintime : '-1 year'
));

echo "<br>";


echo "<br>";
echo elgg_echo('au_random_content:numdisplay') . '<br>';
echo elgg_view('input/dropdown', array(
	'name' => 'params[numdisplay]',
	'value' => $widget->numdisplay ? $widget->numdisplay : 5,
	'options' => range(1, 20)
));

<?php

namespace AU\Widgets;

echo elgg_echo('tabtext:admin:filter');
echo "<br>";

$options = array(
    'name' => 'params[nofilter]',
    'value' => $vars['entity']->nofilter ? $vars['entity']->nofilter : 'yes',
    'options_values' => array(
        'yes' => elgg_echo('option:yes'),
        'no' => elgg_echo('option:no')
    )
);

echo elgg_view('input/dropdown', $options);

echo "<br><br>";
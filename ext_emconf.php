<?php

$EM_CONF['jar_assets'] = [
	'title' => 'Multiple Assets',
	'description' => 'Includes all CSS and JavaScript files of a folder.',
	'category' => 'plugin',
	'author' => 'invokable GmbH',
	'author_email' => 'info@invokable.gmbh',
	'version' => '3.0.0',
	'state' => 'stable',
	'constraints' => [
		'depends' => [
			'typo3' => '13.4.0-13.4.99',
			'jar_utilities' => '^3.0'
		],
		'conflicts' => [
		],
		'suggests' => [
		],
	],
];

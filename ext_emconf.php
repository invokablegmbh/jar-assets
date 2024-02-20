<?php

$EM_CONF['jar_assets'] = array(
	'title' => 'Multiple Assets',
	'description' => 'Includes all CSS and JavaScript files of a folder.',
	'category' => 'plugin',
	'author' => 'invokable GmbH',
	'author_email' => 'info@invokable.gmbh',
	'version' => '2.0.3',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'constraints' => array(
		'depends' => array(
			'typo3' => '12.4.1-12.4.99',
			'jar_utilities' => '^2.0'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

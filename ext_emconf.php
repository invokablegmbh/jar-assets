<?php

$EM_CONF['jar_assets'] = array(
	'title' => 'Multiple Assets',
	'description' => 'Includes all CSS and JavaScript files of a folder.',
	'category' => 'plugin',
	'author' => 'invokable GmbH',
	'author_email' => 'info@invokable.gmbh',
	'version' => '1.0.4',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'constraints' => array(
		'depends' => array(
			'typo3' => '10.4.1-11.5.99',
			'php' => '7.4.0-7.4.999',
			'jar_utilities' => '1.0.0'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);
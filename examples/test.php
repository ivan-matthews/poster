<?php

	use IvanMatthews\Poster\Poster;

	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";
	include_once __DIR__ . "/../src/Poster.php";

	include __DIR__ . "/helpers/functions.php";

//	unset($GLOBALS['_SERVER']);
	$host = ivanMatthewsPosterUniqueFunctionPrefix__getRemoteHost() or die('unknown http host');

	$poster = new Poster($host);

	$poster->field('name', array(
		'values takoe to [array]',
		'values takoe to1 [array]',
		'values takoe to2 [array]'
	));
	$poster->field('name1', 'values takoe to [string]');

	$poster->file('file_1', array(
			'one' => __DIR__ . '/files/another_file.svg',
			'two' => __DIR__ . '/files/file.svg')
	);
	$poster->file('file_2', __DIR__ . '/files/file.svg');
	$poster->file('file_3', __DIR__ . '/files/another_file.svg');

	$poster->param('get_param', 'get_value');

//	$poster->multiPartFormData();
//	pre($poster->getRequestBody());

	$poster->ready();
	$poster->post();

	pre($poster->getResponseContent());



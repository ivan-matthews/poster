<?php

	use IvanMatthews\Poster\Single;

	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";
	include_once __DIR__ . "/../src/Helpers/Statical.php";
	include_once __DIR__ . "/../src/Poster.php";
	include_once __DIR__ . "/../src/Response.php";
	include_once __DIR__ . "/../src/Single.php";

	include_once __DIR__ . "/helpers/functions.php";

//	unset($GLOBALS['_SERVER']);
	$host = getPosterRemoteHost() or die('unknown http host');

	$poster = new Single($host);

	$poster->field('simple', 'value');
	$poster->field('simple_1', 'some value');

	$poster->param('get_param', 'get_value');

	$poster = $poster->ready()
		->post();

	pre(
		$poster->getHeaders(true),
		$poster->getHeaders(false),
		$poster->getContent()
	);


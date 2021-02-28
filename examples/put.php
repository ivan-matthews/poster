<?php

	use IvanMatthews\Poster\Poster;
	use IvanMatthews\Poster\Interfaces\Common;
	use IvanMatthews\Poster\Helpers\Statical;

	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";
	include_once __DIR__ . "/../src/Helpers/Statical.php";
	include_once __DIR__ . "/../src/Poster.php";

	include_once __DIR__ . "/helpers/functions.php";

//	unset($GLOBALS['_SERVER']);
	$host = getPosterRemoteHost() or die('unknown http host');

	$poster = new Poster($host);

	$poster->field('simple', 'value');
	$poster->field('simple_1', 'some value');

	$poster->ready()
		->call(function (Common $poster) {
			$opts = array(
				'http' => array_merge(array(
					'method' => 'PUT',
					'header' => Statical::http_build_headers($poster->getHeaders()),
					'content' => json_encode($poster->getFields())
				), $poster->getHttp())
			);
			$poster->setContext(stream_context_create($opts));
			$poster->setUrl($poster->getAction());
		});

	pre($poster->getResponseContent());
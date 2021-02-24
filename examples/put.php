<?php

	use IvanMatthews\Poster\Poster;
	use IvanMatthews\Poster\Interfaces\Common;

	include_once __DIR__ . "/../src/Poster.php";
	include_once __DIR__ . "/../src/interfaces/Common.php";
	include_once __DIR__ . "/../src/interfaces/Getters.php";
	include_once __DIR__ . "/../src/interfaces/Poster.php";
	include_once __DIR__ . "/../src/interfaces/Setters.php";
	include_once __DIR__ . "/../src/traits/Getters.php";
	include_once __DIR__ . "/../src/traits/Setters.php";

	error_reporting(E_ALL);
	ini_set('display_errors', '1');


	$poster = new Poster('https://php.net');

	$poster->field('simple','value');
	$poster->field('simple_1','some value');

	$poster->ready()
		->call(function(Common $poster){
			$opts = array(
				'http'	=> array_merge(array(
					'method'	=> 'PUT',
					'header'	=> Poster::http_build_headers($poster->getHeaders()),
					'content'	=> json_encode($poster->getFields())
				), $poster->getHttp())
			);
			$poster->setContext(stream_context_create($opts));
			$poster->setUrl($poster->getAction());
		});

	exit($poster->getResponseContent());



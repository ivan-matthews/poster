<?php

	use IvanMatthews\Poster\Poster;
	use IvanMatthews\Poster\Interfaces\Common;

	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";
	include_once __DIR__ . "/../src/Poster.php";

	if (!function_exists('pre')) {
		function pre(...$_)
		{
			print '<pre>';
			foreach ($_ as $item) {
				print_r($item);
				print '<hr>';
			}
			die('</pre>');
		}
	}

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$poster = new Poster('https://php.net');

	$poster->field('simple', 'value');
	$poster->field('simple_1', 'some value');

	$poster->ready()
		->call(function (Common $poster) {
			$opts = array(
				'http' => array_merge(array(
					'method' => 'PUT',
					'header' => Poster::http_build_headers($poster->getHeaders()),
					'content' => json_encode($poster->getFields())
				), $poster->getHttp())
			);
			$poster->setContext(stream_context_create($opts));
			$poster->setUrl($poster->getAction());
		});

	pre($poster->getResponseContent());


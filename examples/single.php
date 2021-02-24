<?php

	use IvanMatthews\Poster\Single;

	include_once __DIR__ . "/../src/Poster.php";
	include_once __DIR__ . "/../src/Response.php";
	include_once __DIR__ . "/../src/Single.php";
	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$poster = new Single('https://php.net');

	$poster->field('simple','value');
	$poster->field('simple_1','some value');

	$poster = $poster->ready()
		->post();

	pre(
		$poster->getHeaders(true),
		$poster->getHeaders(false),
		$poster->getContent()
	);


	if(!function_exists('pre')){
		function pre(...$_){
			print '<pre>';
			foreach($_ as $item){
				print_r($item);
				print '<hr>';
			}
			die('</pre>');
		}
	}

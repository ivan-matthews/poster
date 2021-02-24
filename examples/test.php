<?php

	use IvanMatthews\Poster\Poster;

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

	$poster->field('name', array(
		'values takoe to [array]',
		'values takoe to1 [array]',
		'values takoe to2 [array]'
	));
	$poster->field('name1', 'values takoe to [string]');

	$poster->file('file_1', array(
			'one' => __DIR__ . '/files/another_file.txt',
			'two' => __DIR__ . '/files/file.txt')
	);
	$poster->file('file_2', __DIR__ . '/files/file.txt');
	$poster->file('file_3', __DIR__ . '/files/another_file.txt');

//	$poster->multiPartFormData();
//	exit($poster->getRequestBody());

	$poster->ready();
	$poster->post();

	pre($poster->getResponseContent());



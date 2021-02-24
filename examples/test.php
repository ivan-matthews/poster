<?php

	use IvanMatthews\Poster\Poster;

	include_once __DIR__ . "/../src/Poster.php";

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
		'one'=>__DIR__ . '/files/another_file.txt',
		'two'=>__DIR__ . '/files/file.txt')
	);
	$poster->file('file_2', __DIR__ . '/files/file.txt');
	$poster->file('file_3', __DIR__ . '/files/another_file.txt');

//	$poster->multiPartFormData();
//	exit($poster->getRequestBody());

	$poster->ready();
	$poster->post();

	pre($poster->getResponseContent());


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

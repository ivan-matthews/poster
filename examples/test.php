<?php

	use IvanMatthews\Poster\Poster;

	include __DIR__ . "/../src/Poster.php";

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$poster = new Poster('http://my.c/home/blabla');

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

	$poster->send();
	$poster->post();

	print $poster->getContent();


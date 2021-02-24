<?php

	use IvanMatthews\Poster\Poster;

	include_once __DIR__ . "/../src/Poster.php";

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$poster = new Poster('https://ru.lipsum.com/feed/json');
	
	$poster->field('amount', rand(5,20));
	$poster->field('what', 'paras');
	$poster->field('start', 'yes');
	$poster->field('generate', 'Сгенерировать Lorem Ipsum');
	
	$poster->ready()
		->post();
		
	$content = json_decode($poster->getResponseContent(), true);
	
	$loremIpsumDollor = isset($content['feed']['lipsum']) ? $content['feed']['lipsum'] : null;
	
	var_dump($loremIpsumDollor);

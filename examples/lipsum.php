<?php

	use IvanMatthews\Poster\Poster;

	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";
	include_once __DIR__ . "/../src/Helpers/Statical.php";
	include_once __DIR__ . "/../src/Poster.php";

	include_once __DIR__ . "/helpers/functions.php";

	$poster = new Poster('https://ru.lipsum.com/feed/json');

	$poster->field('amount', rand(5, 20));
	$poster->field('what', 'paras');
	$poster->field('start', 'yes');
	$poster->field('generate', 'Сгенерировать Lorem Ipsum');

	$poster->ready()
		->post();

	$content = json_decode($poster->getResponseContent(), true);

	$loremIpsumDollor = isset($content['feed']['lipsum']) ? $content['feed']['lipsum'] : null;

	pre($loremIpsumDollor);


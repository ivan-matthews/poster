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

	$poster = new \IvanMatthews\Poster\Poster('https://api.github.com/repos/ivan-matthews/poster/tags');
	
	$poster->header('Accept','application/vnd.github.v3+json');
	$poster->header('user-agent', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36');
	$poster->ready();
	$poster->get();

	$response = json_decode($poster->getResponseContent(), true);
	
	$zipURL = isset($response[0]['zipball_url']) ? $response[0]['zipball_url'] : null;

	if($zipURL){
		$file_name = basename($zipURL) . '.zip';
	
		$poster = new \IvanMatthews\Poster\Poster($zipURL);
		$poster->header('user-agent', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36');
		$poster->ready();
		$poster->get();
		file_put_contents('files/' . $file_name, $poster->getResponseContent());
		exit('<a href="files/' . $file_name . '">' . $file_name . '</a>');
	}
	exit('Not found');
	
	

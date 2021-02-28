<?php

	include __DIR__ . "/../helpers/functions.php";

	pre(
		array('method' => $_SERVER['REQUEST_METHOD']),
		array('data' => file_get_contents('php://input')),
		array('request list' => $_REQUEST),
		array('get list' => $_GET),
		array('post list' => $_POST),
		array('files list' => $_FILES)
	);
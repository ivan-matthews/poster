<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	if(!function_exists('getPosterRemoteHost')){
		function getPosterRemoteHost($server_site = 'server/site.php'){
			if(isset($_SERVER['REQUEST_SCHEME']) && isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI'])){
				$dir = trim(dirname($_SERVER['REQUEST_URI']), '/');
				return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $dir . '/' . $server_site;
			}
			return null;
		}
	}

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

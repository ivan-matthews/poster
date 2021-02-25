<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	if(!function_exists('ivanMatthewsPosterUniqueFunctionPrefix__getRemoteHost')){
		function ivanMatthewsPosterUniqueFunctionPrefix__getRemoteHost($server_site = 'server/site.php'){
			$host = null;
			if(isset($_SERVER['SCRIPT_FILENAME'])){
				$file = explode('vendor', $_SERVER['SCRIPT_FILENAME']);
				if(isset($file[1]) && isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_SCHEME'])){
					$dir = trim(dirname($file[1]),'/');
					$host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/vendor/' . $dir . '/' . $server_site;
				}
			}
			return $host;
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


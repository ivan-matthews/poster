<?php

	use IvanMatthews\Poster\Poster;
	use IvanMatthews\Poster\Response;

	include_once __DIR__ . "/../src/Interfaces/Common.php";
	include_once __DIR__ . "/../src/Interfaces/Getters.php";
	include_once __DIR__ . "/../src/Interfaces/Poster.php";
	include_once __DIR__ . "/../src/Interfaces/Setters.php";
	include_once __DIR__ . "/../src/Traits/Getters.php";
	include_once __DIR__ . "/../src/Traits/Setters.php";
	include_once __DIR__ . "/../src/Poster.php";
	include_once __DIR__ . "/../src/Response.php";

	include __DIR__ . "/helpers/functions.php";

//	unset($GLOBALS['_SERVER']);
	$host = ivanMatthewsPosterUniqueFunctionPrefix__getRemoteHost() or die('unknown http host');

	$poster = new Poster($host);

	$poster->field('simple', 'value');
	$poster->field('simple_1', 'some value');

	$poster->ready()
		->post();

	/**
	 * @result
	 * Array
	 * (
	 *    [0] => HTTP/1.1 301 Moved Permanently
	 *    [Server] => Array
	 *        (
	 *            [0] => myracloud
	 *            [1] => myracloud
	 *        )
	 *    [Date] => Array
	 *        (
	 *            [0] => Wed, 24 Feb 2021 17:15:32 GMT
	 *            [1] => Wed, 24 Feb 2021 17:15:32 GMT
	 *        )
	 *    [Content-Type] => Array
	 *        (
	 *            [0] => text/html
	 *            [1] => text/html; charset=utf-8
	 *        )
	 *    [Content-Length] => 161
	 *    [Connection] => Array
	 *        (
	 *            [0] => close
	 *            [1] => close
	 *        )
	 *    [Location] => https://www.php.net/
	 *    [1] => HTTP/1.1 200 OK
	 *    [Last-Modified] => Wed, 24 Feb 2021 17:10:06 GMT
	 *    [Content-language] => en
	 *    [X-Frame-Options] => SAMEORIGIN
	 *    [Set-Cookie] => Array
	 *        (
	 *            [0] => COUNTRY=NA%2C95.85.83.6; expires=Wed, 03-Mar-2021 17:15:32 GMT; Max-Age=604800; path=/; domain=.php.net
	 *            [1] => LAST_NEWS=1614186932; expires=Thu, 24-Feb-2022 17:15:32 GMT; Max-Age=31536000; path=/; domain=.php.net
	 *        )
	 *    [Link] => ; rel=shorturl
	 *    [Expires] => Wed, 24 Feb 2021 17:15:32 GMT
	 *    [Cache-Control] => max-age=0
	 * )
	 *
	 * Array
	 * (
	 *    [0] => HTTP/1.1 301 Moved Permanently
	 *    [1] => Server: myracloud
	 *    [2] => Date: Wed, 24 Feb 2021 17:15:32 GMT
	 *    [3] => Content-Type: text/html
	 *    [4] => Content-Length: 161
	 *    [5] => Connection: close
	 *    [6] => Location: https://www.php.net/
	 *    [7] => HTTP/1.1 200 OK
	 *    [8] => Server: myracloud
	 *    [9] => Date: Wed, 24 Feb 2021 17:15:32 GMT
	 *    [10] => Content-Type: text/html; charset=utf-8
	 *    [11] => Connection: close
	 *    [12] => Last-Modified: Wed, 24 Feb 2021 17:10:06 GMT
	 *    [13] => Content-language: en
	 *    [14] => X-Frame-Options: SAMEORIGIN
	 *    [15] => Set-Cookie: COUNTRY=NA%2C95.85.83.6; expires=Wed, 03-Mar-2021 17:15:32 GMT; Max-Age=604800; path=/; domain=.php.net
	 *    [16] => Set-Cookie: LAST_NEWS=1614186932; expires=Thu, 24-Feb-2022 17:15:32 GMT; Max-Age=31536000; path=/; domain=.php.net
	 *    [17] => Link: ; rel=shorturl
	 *    [18] => Expires: Wed, 24 Feb 2021 17:15:32 GMT
	 *    [19] => Cache-Control: max-age=0
	 * )
	 */
//	pre($poster->getResponseHeaders(), $poster->getResponseHeaders(false), $poster->getResponseContent());	// 3 requests

	/**
	 * @result
	 * Array
	 * (
	 *    [0] => HTTP/1.1 301 Moved Permanently
	 *    [Server] => Array
	 *        (
	 *            [0] => myracloud
	 *            [1] => myracloud
	 *        )
	 *    [Date] => Array
	 *        (
	 *            [0] => Wed, 24 Feb 2021 17:15:15 GMT
	 *            [1] => Wed, 24 Feb 2021 17:15:16 GMT
	 *        )
	 *    [Content-Type] => Array
	 *        (
	 *            [0] => text/html
	 *            [1] => text/html; charset=utf-8
	 *        )
	 *    [Content-Length] => 161
	 *    [Connection] => Array
	 *        (
	 *            [0] => close
	 *            [1] => close
	 *        )
	 *    [Location] => https://www.php.net/
	 *    [1] => HTTP/1.1 200 OK
	 *    [Last-Modified] => Wed, 24 Feb 2021 17:10:06 GMT
	 *    [Content-language] => en
	 *    [X-Frame-Options] => SAMEORIGIN
	 *    [Set-Cookie] => Array
	 *        (
	 *            [0] => COUNTRY=NA%2C95.85.83.6; expires=Wed, 03-Mar-2021 17:15:16 GMT; Max-Age=604800; path=/; domain=.php.net
	 *            [1] => LAST_NEWS=1614186916; expires=Thu, 24-Feb-2022 17:15:16 GMT; Max-Age=31536000; path=/; domain=.php.net
	 *        )
	 *    [Link] => ; rel=shorturl
	 *    [Expires] => Wed, 24 Feb 2021 17:15:16 GMT
	 *    [Cache-Control] => max-age=0
	 * )
	 *
	 * Array
	 * (
	 *    [0] => HTTP/1.1 301 Moved Permanently
	 *    [1] => Server: myracloud
	 *    [2] => Date: Wed, 24 Feb 2021 17:15:16 GMT
	 *    [3] => Content-Type: text/html
	 *    [4] => Content-Length: 161
	 *    [5] => Connection: close
	 *    [6] => Location: https://www.php.net/
	 *    [7] => HTTP/1.1 200 OK
	 *    [8] => Server: myracloud
	 *    [9] => Date: Wed, 24 Feb 2021 17:15:16 GMT
	 *    [10] => Content-Type: text/html; charset=utf-8
	 *    [11] => Connection: close
	 *    [12] => Last-Modified: Wed, 24 Feb 2021 17:10:06 GMT
	 *    [13] => Content-language: en
	 *    [14] => X-Frame-Options: SAMEORIGIN
	 *    [15] => Set-Cookie: COUNTRY=NA%2C95.85.83.6; expires=Wed, 03-Mar-2021 17:15:16 GMT; Max-Age=604800; path=/; domain=.php.net
	 *    [16] => Set-Cookie: LAST_NEWS=1614186916; expires=Thu, 24-Feb-2022 17:15:16 GMT; Max-Age=31536000; path=/; domain=.php.net
	 *    [17] => Link: ; rel=shorturl
	 *    [18] => Expires: Wed, 24 Feb 2021 17:15:16 GMT
	 *    [19] => Cache-Control: max-age=0
	 * )
	 */
	$response = new Response($poster);
	$response->load();
	pre($response->getHeaders(), $response->getHeaders(false), $response->getContent());        // 1 request



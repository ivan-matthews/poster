<?php

	namespace IvanMatthews\Poster\Interfaces;

	interface Poster
	{
		public function action($action);

		public function enctype($enctype);

		public function file($field, $value);

		public function field($field, $value);

		public function header($key, $value);

		public function cookie($key, $value);

		public function http($key, $value);

		public function multiPartFormData();

		public function getRequestBody();

		public function textPlain();

		public function applicationXWwwFormUrlEncoded();

		public function ready();

		public function get();

		public function post();

		public function head();

		public function any($method, $action = null);

		public function getResponseContent();

		public function getResponseHeaders($assoc = true);

		public function call(callable $callback);
	}
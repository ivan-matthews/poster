<?php

	namespace IvanMatthews\Poster\Interfaces;

	interface Common{
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
		public function any($method);
		public function getResponseContent();
		public function getResponseHeaders($assoc = true);
		public function call(callable $callback);
		public function getEnctype();
		public function getAction();
		public function getBoundary();
		public function getFiles();
		public function getFields();
		public function getHeaders();
		public function getCookies();
		public function getHttp();
		public function getUrl();
		public function getContext();
		public function getRequest();
		public function setEnctype($enctype);
		public function setAction($action);
		public function setBoundary($boundary);
		public function setFiles(array $files);
		public function setFields(array $fields);
		public function setHeaders(array $headers);
		public function setCookies(array $cookies);
		public function setHttp(array $http);
		public function setUrl($url);
		public function setContext($context);
		public function setRequest($request);
	}
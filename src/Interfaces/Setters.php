<?php

	namespace IvanMatthews\Poster\Interfaces;

	interface Setters{
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
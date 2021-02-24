<?php

	namespace IvanMatthews\Poster\Traits;

	trait Setters
	{
		public function setEnctype($enctype){
			$this->request_enctype = $enctype;
			return $this;
		}

		public function setAction($action){
			$this->request_action = $action;
			return $this;
		}

		public function setBoundary($boundary){
			$this->request_boundary = $boundary;
			return $this;
		}

		public function setFiles(array $files){
			$this->files = $files;
			return $this;
		}

		public function setFields(array $fields){
			$this->fields = $fields;
			return $this;
		}

		public function setHeaders(array $headers){
			$this->headers = $headers;
			return $this;
		}

		public function setCookies(array $cookies){
			$this->cookies = $cookies;
			return $this;
		}

		public function setHttp(array $http){
			$this->http = $http;
			return $this;
		}

		public function setUrl($url){
			$this->url = $url;
			return $this;
		}

		public function setContext($context){
			$this->context = $context;
			return $this;
		}

		public function setRequest($request){
			$this->request = $request;
			return $this;
		}
	}
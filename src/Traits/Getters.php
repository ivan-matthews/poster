<?php

	namespace IvanMatthews\Poster\Traits;

	trait Getters
	{
		public function getEnctype()
		{
			return $this->request_enctype;
		}

		public function getAction()
		{
			return $this->request_action;
		}

		public function getBoundary()
		{
			return $this->request_boundary;
		}

		public function getFiles()
		{
			return $this->files;
		}

		public function getFields()
		{
			return $this->fields;
		}

		public function getHeaders()
		{
			return $this->headers;
		}

		public function getCookies()
		{
			return $this->cookies;
		}

		public function getHttp()
		{
			return $this->http;
		}

		public function getUrl()
		{
			return $this->url;
		}

		public function getContext()
		{
			return $this->context;
		}

		public function getRequest()
		{
			return $this->request;
		}
	}
<?php

	namespace IvanMatthews\Poster;

	use IvanMatthews\Poster\Traits\Getters as GettersTrait;
	use IvanMatthews\Poster\Traits\Setters as SettersTrait;
	use IvanMatthews\Poster\Interfaces\Poster as PosterInterface;
	use IvanMatthews\Poster\Interfaces\Common as CommonInterface;
	use IvanMatthews\Poster\Interfaces\Getters as GettersInterface;
	use IvanMatthews\Poster\Interfaces\Setters as SettersInterface;
	use IvanMatthews\Poster\Helpers\Statical;

	/**
	 * Class Poster
	 * @package IvanMatthews\Poster
	 * @method self put($action = null)
	 * @method self delete($action = null)
	 * @method self trace($action = null)
	 * @method self patch($action = null)
	 * @method self options($action = null)
	 * @method self connect($action = null)
	 */
	class Poster implements PosterInterface, CommonInterface, GettersInterface, SettersInterface
	{
		use GettersTrait;
		use SettersTrait;

		protected $request_enctype;
		protected $request_action;
		protected $request_boundary;

		protected $files = array();
		protected $fields = array();
		protected $headers = array();
		protected $cookies = array();
		protected $http = array();
		protected $params = array();

		protected $url;
		protected $context;
		protected $request = '';

		protected $opts;

		/**
		 * @param $name
		 * @param $arguments
		 * @return PosterInterface
		 */
		public function __call($name, $arguments)
		{
			return $this->any(strtoupper($name), ...$arguments);
		}

		public function __construct($action)
		{
			$this->action($action);
		}

		public function action($action)
		{
			$this->request_action = $action;
			return $this;
		}

		public function enctype($enctype)
		{
			$this->request_enctype = $enctype;
			return $this;
		}

		public function file($field, $value)
		{
			$this->files[$field] = $value;
			return $this;
		}

		public function field($field, $value)
		{
			$this->fields[$field] = $value;
			return $this;
		}

		public function header($key, $value)
		{
			$this->headers[$key] = $value;
			return $this;
		}

		public function cookie($key, $value)
		{
			$this->cookies[$key] = $value;
			return $this;
		}

		public function http($key, $value)
		{
			$this->http[$key] = $value;
			return $this;
		}

		public function param($name, $value)
		{
			$this->params[$name] = $value;
			return $this;
		}

		public function multiPartFormData()
		{
			$this->boundary();
			$this->enctype('multipart/form-data')
				->header('Content-Type', $this->request_enctype . ';boundary=' . $this->request_boundary);
			$this->request = Statical::http_build_multipart_form_data($this->request_boundary , $this->fields, $this->files);
			return $this;
		}

		public function textPlain()
		{
			$this->enctype('text/plain')
				->header('Content-Type', $this->request_enctype);
			$this->request = trim(Statical::http_build_text($this->fields));
			return $this;
		}

		public function applicationXWwwFormUrlEncoded()
		{
			$this->enctype('application/x-www-form-urlencoded')
				->header('Content-Type', $this->request_enctype);
			$this->request = http_build_query($this->fields);
			return $this;
		}

		public function ready()
		{
			$this->prepareRequest();
			$this->header('Cookie', Statical::http_build_cookies($this->cookies));
			return $this;
		}

		public function get()
		{
			$this->opts = array(
				'http' => array_merge(array(
					'method' => 'GET',
					'header' => Statical::http_build_headers($this->headers),
				), $this->http)
			);
			$this->context = stream_context_create($this->opts);
			$this->url = Statical::http_build_uri($this->request_action, http_build_query(array_merge($this->fields, $this->params)));
			return $this;
		}

		public function post()
		{
			$this->header('Content-Length', mb_strlen($this->request));
			$this->opts = array(
				'http' => array_merge(array(
					'method' => 'POST',
					'header' => Statical::http_build_headers($this->headers),
					'content' => $this->request,
				), $this->http)
			);
			$this->context = stream_context_create($this->opts);
			$this->url = Statical::http_build_uri($this->request_action, http_build_query($this->params));
			return $this;
		}

		public function head()
		{
			$this->opts = array(
				'http' => array_merge(array(
					'method' => 'HEAD',
					'header' => Statical::http_build_headers($this->headers),
				), $this->http)
			);
			$this->context = stream_context_create($this->opts);
			$this->url = Statical::http_build_uri($this->request_action, http_build_query(array_merge($this->fields, $this->params)));
			return $this;
		}

		public function any($method, $action = null)
		{
			$this->header('Content-Length', mb_strlen($this->request));
			$this->opts = array(
				'http' => array_merge(array(
					'method' => $method,
					'header' => Statical::http_build_headers($this->headers),
					'content' => $this->request,
				), $this->http)
			);
			$this->context = stream_context_create($this->opts);
			$this->url = $action ?: Statical::http_build_uri($this->request_action,  http_build_query($this->params));
			return $this;
		}

		public function getRequestBody()
		{
			return $this->request;
		}

		public function getResponseContent()
		{
			return file_get_contents($this->url, false, $this->context);
		}

		public function getResponseHeaders($assoc = true)
		{
			return get_headers($this->url, $assoc, $this->context);
		}

		public function call(callable $callback)
		{
			return call_user_func($callback, $this);
		}

		protected function prepareRequest()
		{
			if (!$this->request_enctype) {
				if ($this->files) {
					return $this->multiPartFormData();
				}
				return $this->applicationXWwwFormUrlEncoded();
			}
			return $this;
		}

		protected function boundary()
		{
			if (!$this->request_boundary) {
				$this->request_boundary = str_repeat('-', 27);
				$this->request_boundary .= Statical::gen(30);
			}
			return $this;
		}

		public function getOpts(){
			return $this->opts;
		}
	}

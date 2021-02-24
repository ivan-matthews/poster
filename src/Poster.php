<?php

	namespace IvanMatthews\Poster;

	use IvanMatthews\Poster\Traits\Getters as GettersTrait;
	use IvanMatthews\Poster\Traits\Setters as SettersTrait;
	use IvanMatthews\Poster\Interfaces\Poster as PosterInterface;
	use IvanMatthews\Poster\Interfaces\Common as CommonInterface;
	use IvanMatthews\Poster\Interfaces\Getters as GettersInterface;
	use IvanMatthews\Poster\Interfaces\Setters as SettersInterface;

	/**
	 * Class Poster
	 * @package IvanMatthews\Poster
	 * @method self put()
	 * @method self delete()
	 * @method self trace()
	 * @method self patch()
	 * @method self options()
	 * @method self connect()
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

		protected $url;
		protected $context;
		protected $request = '';

		/**
		 * @param $name
		 * @param $arguments
		 * @return PosterInterface
		 */
		public function __call($name, $arguments)
		{
			return $this->any(strtoupper($name));
		}

		public function __construct($action){
			$this->action($action);
		}

		public function action($action){
			$this->request_action = $action;
			return $this;
		}

		public function enctype($enctype){
			$this->request_enctype = $enctype;
			return $this;
		}

		public function file($field, $value){
			$this->files[$field] = $value;
			return $this;
		}

		public function field($field, $value){
			$this->fields[$field] = $value;
			return $this;
		}

		public function header($key, $value){
			$this->headers[$key] = $value;
			return $this;
		}

		public function cookie($key, $value){
			$this->cookies[$key] = $value;
			return $this;
		}

		public function http($key, $value){
			$this->http[$key] = $value;
			return $this;
		}

		public function multiPartFormData(){
			$this->boundary();
			$this->enctype('multipart/form-data')
				->header('Content-Type', $this->request_enctype . '; ' . 'boundary=' . $this->request_boundary);
			$this->request = "--" . $this->request_boundary;
			if($this->fields){
				$this->request .= "\r\n";
				$this->request .= trim(self::http_build_boundary($this->request_boundary, $this->fields));
			}
			if($this->files){
				$this->request .= "\r\n";
				$this->request .= trim(self::http_build_files($this->request_boundary, $this->files));
			}
			$this->request .= '--' . "\r\n";
			return $this;
		}

		public function getRequestBody(){
			return $this->request;
		}

		public function textPlain(){
			$this->enctype('text/plain')
				->header('Content-Type', $this->request_enctype);
			$this->request = trim(self::http_build_text($this->fields));
			return $this;
		}

		public function applicationXWwwFormUrlEncoded(){
			$this->enctype('application/x-www-form-urlencoded')
				->header('Content-Type', $this->request_enctype);
			$this->request = http_build_query($this->fields);
			return $this;
		}

		public function ready(){
			$this->prepareRequest();
			$this->header('Cookie', self::http_build_cookies($this->cookies));
			return $this;
		}

		public function get(){
			$opts = array(
				'http'	=> array_merge(array(
					'method'	=> 'GET',
					'header'	=> self::http_build_headers($this->headers),
				), $this->http)
			);
			$this->context = stream_context_create($opts);
			$this->url = self::http_build_uri($this->request_action, $this->request);
			return $this;
		}

		public function post(){
			$this->header('Content-Length', mb_strlen($this->request));
			$opts = array(
				'http'	=> array_merge(array(
					'method'	=> 'POST',
					'header'	=> self::http_build_headers($this->headers),
					'content'	=> $this->request,
				), $this->http)
			);
			$this->context = stream_context_create($opts);
			$this->url = $this->request_action;
			return $this;
		}

		public function head(){
			$opts = array(
				'http'	=> array_merge(array(
					'method'	=> 'HEAD',
					'header'	=> self::http_build_headers($this->headers),
				), $this->http)
			);
			$this->context = stream_context_create($opts);
			$this->url = self::http_build_uri($this->request_action, $this->request);
			return $this;
		}

		public function any($method){
			$this->header('Content-Length', mb_strlen($this->request));
			$opts = array(
				'http'	=> array_merge(array(
					'method'	=> $method,
					'header'	=> self::http_build_headers($this->headers),
					'content'	=> $this->request,
				), $this->http)
			);
			$this->context = stream_context_create($opts);
			$this->url = self::http_build_uri($this->request_action, $this->request);
			return $this;
		}

		public function getResponseContent(){
			return file_get_contents($this->url, false, $this->context);
		}

		public function getResponseHeaders($assoc = true){
			return get_headers($this->url, $assoc, $this->context);
		}

		public function call(callable $callback){
			return call_user_func($callback, $this);
		}

		protected function prepareRequest(){
			if(!$this->request_enctype){
				if($this->files){
					return $this->multiPartFormData();
				}
				return $this->applicationXWwwFormUrlEncoded();
			}
			return $this;
		}

		protected function boundary(){
			if(!$this->request_boundary){
				$this->request_boundary = str_repeat('-', 27);
				$this->request_boundary .= self::gen(30);
			}
			return $this;
		}

		public static function gen($length = 32){
			$symbols = array_merge(range(0,9), range('a','z'), range('A','Z'));
			shuffle($symbols);
			$gen = '';
			for($i=0;$i<$length;$i++){
				$gen .= $symbols[rand(0,61)];
			}
			return $gen;
		}

		public static function http_build_cookies(array $cookies_list){
			$cookies = array();
			foreach($cookies_list as $key => $value){
				$cookies[] = $key . '=' . $value;
			}
			return implode('; ', $cookies);
		}

		public static function http_build_headers(array $headers_list){
			$headers = array();
			foreach($headers_list as $key => $value){
				$headers[] = $key . ': ' . $value;
			}
			return implode("\r\n", $headers);
		}

		public static function http_build_uri($action, $content){
			return $action . '?' . $content;
		}

		public static function http_build_boundary($boundary, $fields_list, $key = null){
			$content = '';
			foreach($fields_list as $field_name => $field_value){
				$field_name = $key ? "{$key}[$field_name]" : $field_name;
				if(is_array($field_value)){
					$content .= self::http_build_boundary($boundary, $field_value, $field_name);
				}else{
					$content .= "Content-Disposition: form-data; name=\"{$field_name}\"\r\n\r\n";
					$content .= "{$field_value}\r\n";
					$content .= "--" . $boundary . "\r\n";
				}
			}
			return $content;
		}

		public static function http_build_files($boundary, $files_list, $key = null){
			$content = '';
			foreach($files_list as $field_name => $field_value){
				$field_name = $key ? "{$key}[$field_name]" : $field_name;
				if(is_array($field_value)){
					$content .= self::http_build_files($boundary, $field_value, $field_name);
				}else{
					$content .= "Content-Disposition: form-data; name=\"{$field_name}\"; filename=\"" . basename($field_value) . "\"\r\n";
					$content .= "Content-Type: " . mime_content_type($field_value) . "\r\n\r\n";
					$content .= file_get_contents($field_value) . "\r\n";
					$content .= "--" . $boundary . "\r\n";
				}
			}
			return $content;
		}

		public static function http_build_text($fields_list, $field_name = null){
			$fields = '';
			foreach($fields_list as $key => $value){
				$key = $field_name ? "{$field_name}[$key]" : $key;
				if(is_array($value)){
					$fields .= self::http_build_text($value, $key);
				}else{
					$fields .= $key . '=' . str_replace(' ','+',$value) . "\r\n";
				}
			}
			return $fields;
		}
	}

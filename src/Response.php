<?php

	namespace IvanMatthews\Poster;

	use IvanMatthews\Poster\Interfaces\Common;

	class Response
	{
		protected $poster;
		protected $content = '';
		protected $headers = array();

		public function __construct(Common $poster)
		{
			$this->poster = $poster;
		}

		public function load()
		{
			$this->content = file_get_contents($this->poster->getUrl(), false, $this->poster->getContext());
			$this->headers = isset($http_response_header) ? $http_response_header : array();
			return $this;
		}

		public function getContent()
		{
			return $this->content;
		}

		public function getHeaders($format = true)
		{
			if ($format) {
				return $this->formatHeaders();
			}
			return $this->headers;
		}

		protected function formatHeaders()
		{
			$headers = array();
			foreach ($this->headers as $header) {
				preg_match("#(.*?): (.*?)#U", $header, $result);
				if (isset($result[1]) && isset($result[2])) {
					$headers[trim($result[1])][] = trim($result[2]);
				} else {
					$headers[] = $header;
				}
			}
			return $this->mergeHeaders($headers);
		}

		protected function mergeHeaders($headers)
		{
			foreach ($headers as $name => $value) {
				if (is_array($value) && !key_exists(1, $value)) {
					$headers[$name] = $value[0];
				}
			}
			return $headers;
		}
	}
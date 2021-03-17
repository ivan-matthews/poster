<?php

	namespace IvanMatthews\Poster\Helpers;

	class Statical
	{
		public static function gen($length = 32)
		{
			$symbols = array_merge(range(0,9), range('a','z'), range('A','Z'));
			$gen = '';
			for($i = 0; $i < $length; $i++){
				$gen .= $symbols[rand(0,61)];
			}
			return $gen;
		}

		public static function http_build_cookies(array $cookies_list)
		{
			$cookies = array();
			foreach ($cookies_list as $key => $value) {
				$cookies[] = $key . '=' . $value;
			}
			return implode('; ', $cookies);
		}

		public static function http_build_headers(array $headers_list)
		{
			$headers = array();
			foreach ($headers_list as $key => $value) {
				$headers[] = $key . ': ' . $value;
			}
			return implode("\r\n", $headers);
		}

		public static function http_build_uri($action, $content)
		{
			return $content ? $action . '?' . $content : $action;
		}

		public static function http_build_boundary_fields($boundary, $fields_list, $key = null)
		{
			$content = '';
			foreach ($fields_list as $field_name => $field_value) {
				$field_name = $key ? "{$key}[$field_name]" : $field_name;
				if (is_array($field_value)) {
					$content .= self::http_build_boundary_fields($boundary, $field_value, $field_name);
				} else {
					$content .= "Content-Disposition: form-data; name=\"{$field_name}\"\r\n\r\n";
					$content .= "{$field_value}\r\n";
					$content .= "--" . $boundary . "\r\n";
				}
			}
			return $content;
		}

		public static function http_build_boundary_files($boundary, $files_list, $key = null)
		{
			$content = '';
			foreach ($files_list as $field_name => $field_value) {
				$field_name = $key ? "{$key}[$field_name]" : $field_name;
				if (is_array($field_value)) {
					$content .= self::http_build_boundary_files($boundary, $field_value, $field_name);
				} else {
					$content .= "Content-Disposition: form-data; name=\"{$field_name}\"; filename=\"" . basename($field_value) . "\"\r\n";
					$content .= "Content-Type: " . mime_content_type($field_value) . "\r\n\r\n";
					$content .= file_get_contents($field_value) . "\r\n";
					$content .= "--" . $boundary . "\r\n";
				}
			}
			return $content;
		}

		public static function http_build_multipart_form_data($boundary, $fields, $files){
			$request = "--" . $boundary;
			if ($fields) {
				$request .= "\r\n";
				$request .= trim(self::http_build_boundary_fields($boundary, $fields));
			}
			if ($files) {
				$request .= "\r\n";
				$request .= trim(self::http_build_boundary_files($boundary, $files));
			}
			return $request . '--' . "\r\n";
		}

		public static function http_build_text($fields_list, $field_name = null)
		{
			$fields = '';
			foreach ($fields_list as $key => $value) {
				$key = $field_name ? "{$field_name}[$key]" : $key;
				if (is_array($value)) {
					$fields .= self::http_build_text($value, $key);
				} else {
					$fields .= $key . '=' . str_replace(' ', '+', $value) . "\r\n";
				}
			}
			return $fields;
		}
	}
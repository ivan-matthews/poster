<?php

	namespace IvanMatthews\Poster\Interfaces;

	interface Getters
	{
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
	}
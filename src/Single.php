<?php

	namespace IvanMatthews\Poster;

	/**
	 * Class Single
	 * @package IvanMatthews\Poster
	 * @method Response put()
	 * @method Response delete()
	 * @method Response trace()
	 * @method Response patch()
	 * @method Response options()
	 * @method Response connect()
	 */
	class Single extends Poster
	{

		public function __construct($action){
			parent::__construct($action);
		}

		/**
		 * @return Response
		 */
		public function get(){
			parent::get();
			return (new Response($this))->load();
		}

		/**
		 * @return Response
		 */
		public function post(){
			parent::post();
			return (new Response($this))
				->load();
		}

		/**
		 * @return Response
		 */
		public function head(){
			parent::head();
			return (new Response($this))
				->load();
		}

		/**
		 * @param $method
		 * @return Response
		 */
		public function any($method){
			parent::any($method);
			return (new Response($this))
				->load();
		}
	}
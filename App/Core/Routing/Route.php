<?php


namespace App\Core\Routing;


class Route {
	private $method;
	private $path;
	private $controller;
	private $action;

	public function __construct($method, $path, $controller, $action) {
		$this->method = $method;
		$this->path = $path;
		$this->pathSegments = explode("/", $this->path);
		$this->controller = $controller;
		$this->action = $action;
	}

	public function match($path) {
		if(strpos($this->path, "*") === FALSE) {
			return $this->simpleMatch($path);
		} else {
			return $this->advancedMatch($path);
		}
	}

	public function simpleMatch($path) {
		if($this->path == $path) {
			return true;
		}

		return false;
	}

	public function eachSegment($path, $callback) {
		$collector = [];
		$requestSegments = explode("/", $path);
		foreach($requestSegments as $index => $segment) {
			$return = $callback($this->pathSegments[$index], $segment);
			if($return !== null)
				$collector[] = $return;
		}
		return $collector;
	}

	public function advancedMatch($path) {
		$collected = $this->eachSegment($path, function($route, $request) {
			if($route !== "*") {
				// if a segment doesn't match, return false right away
				if ($route !== $request)
					return false;
				// otherwise continue to next segment
			}

			return true;
		});

		return !(in_array(false, $collected));
	}

	public function parseParameters($path) {
		return $this->eachSegment($path, function($route, $request) {
			if($route === "*") {
				return $request;
			} else
				return null;
		});
	}

	public function invokeController($path) {
		$reflection = new \ReflectionClass($this->controller);
		$controller = $reflection->newInstance();

		call_user_func_array([$controller, $this->getAction()], $this->parseParameters($path));
	}

	/**
	 * @return mixed
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @param mixed $method
	 */
	public function setMethod($method)
	{
		$this->method = $method;
	}

	/**
	 * @return mixed
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param mixed $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * @return mixed
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * @param mixed $controller
	 */
	public function setController($controller)
	{
		$this->controller = $controller;
	}

	/**
	 * @return mixed
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * @param mixed $action
	 */
	public function setAction($action)
	{
		$this->action = $action;
	}
}
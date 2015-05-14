<?php


namespace App\Core\Routing;

/**
 * Class Route
 * @package App\Core\Routing
 */
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

	/**
	 * Checks all routes and returns if given
	 * path matches this route's path
	 *
	 * @param $path
	 * @return bool
	 */
	public function match($path) {
		if(strpos($this->path, "*") === FALSE) {
			return $this->simpleMatch($path);
		} else {
			return $this->advancedMatch($path);
		}
	}

	/**
	 * Performs $callback on each segment of path,
	 * returns all returns of all callback calls
	 *
	 * @param $path
	 * @param $callback
	 * @return array
	 */
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

	/**
	 * Performs simple match,
	 * matching strings exactly
	 *
	 * @param $path
	 * @return bool
	 */
	public function simpleMatch($path) {
		if($this->path == $path) {
			return true;
		}

		return false;
	}

	/**
	 * Performs advanced match,
	 * matching route with wildcards, too
	 * (slower than simple match)
	 *
	 * @param $path
	 * @return bool
	 */
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

	/**
	 * Returns segments matching this route's wildcard
	 *
	 * @param $path
	 * @return array
	 */
	public function parseParameters($path) {
		return $this->eachSegment($path, function($route, $request) {
			if($route === "*") {
				return $request;
			} else
				return null;
		});
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
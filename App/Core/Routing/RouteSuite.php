<?php


namespace App\Core\Routing;

/**
 * Class that holds all routes
 *
 * Class RouteSuite
 * @package App\Core\Routing
 */
class RouteSuite {
	/**
	 * @var Route[]
	 */
	private $routes;

	public function addRoute(Route $r) {
		$this->routes[] = $r;
	}

	public function getRoutes() {
		return $this->routes;
	}
}
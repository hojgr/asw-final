<?php


namespace App\Core\Routing;


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
<?php


namespace App\Core\Routing;


use App\Core\DI\DependencyInjectionContainer;
use app\di\DIContainer;

class Router {

	/**
	 * @var DIContainer
	 */
	private $di;

	/**
	 * @var string
	 */
	private $routeFile;

	/**
	 * @var RouteSuite
	 */
	private $routes;

	public function __construct(DependencyInjectionContainer $di) {
		$this->di = $di;
	}

	public function setRouteFile($path) {
		$this->routeFile = $path;
	}

	/**
	 * Reads route file and parses it into RouteSuite
	 * The structure of file is
	 * <method> <path> <controller>:<action>
	 *
	 * @return RouteSuite
	 */
	public function readRoutes() {
		$contents = file_get_contents($this->routeFile);
		$contentsSplit = preg_split("/(\r\n|\r|\n)/", $contents);

		$routeSuite = new RouteSuite();

		foreach($contentsSplit as $routeLine) {
			list($method, $path, $handler) = preg_split('/\s+/', $routeLine);
			list($controller, $action) = explode(":", $handler);

			$route = new Route($method, $path, $controller, $action);
			$routeSuite->addRoute($route);
		}

		return $routeSuite;
	}

	public function initialize() {
		$this->routes = $this->readRoutes();

	}

	public function handle($path) {
		foreach($this->routes->getRoutes() as $route) {
			if($route->match($path)) {
				$route->invokeController($path);
				break;
			}
		}
	}
}
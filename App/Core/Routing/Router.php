<?php


namespace App\Core\Routing;


use App\Core\DI\DependencyInjectionContainer;
use App\Core\Request\Request;
use app\di\DIContainer;

/**
 * Routes requests
 *
 * Class Router
 * @package App\Core\Routing
 */
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

	/**
	 * @param string $path
	 * @return void
	 */
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
			if(strlen($routeLine) != 0 && $routeLine[0] != "#") {
				list($method, $path, $handler) = preg_split('/\s+/', $routeLine);
				list($controller, $action) = explode("::", $handler);

				$route = new Route($method, $path, $controller, $action);
				$routeSuite->addRoute($route);
			}
		}

		return $routeSuite;
	}

	/**
	 * Initializes
	 * @return void
	 */
	public function initialize() {
		$this->routes = $this->readRoutes();

	}

	/**
	 * Returns a matching route
	 *
	 * @param Request $request
	 * @return Route
	 */
	public function getRoute(Request $request) {
		foreach($this->routes->getRoutes() as $route) {
			if($route->match($request)) {
				return $route;
				break;
			}
		}

		return null;
	}
}
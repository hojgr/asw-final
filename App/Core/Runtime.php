<?php


namespace App\Core;


use App\Core\DI\DependencyInjectionContainer;

class Runtime {

	/**
	 * @var DependencyInjectionContainer
	 */
	private $dic;

	/**
	 * @var string
	 */
	private $route_file;

	/**
	 * @var array
	 */
	private $options;

	public function __construct(DependencyInjectionContainer $dic) {
		$this->dic = $dic;
	}

	/**
	 * @param $config_file
	 * @param array $options
	 */
	public function initialize($config_file, $options = []) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		$this->route_file = $config_file;
		$this->options = $options;

		$this->initializeRouter();
	}

	public function initializeRouter() {
		$router = $this->dic->getRouter();

		$router->setRouteFile($this->route_file);
		$router->initialize();

		$router->handle($_SERVER['REQUEST_URI']);
	}
}